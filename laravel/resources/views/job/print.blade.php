<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Print | Monic </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
  
  <style>
    .wrapper {
      padding: 20px;
    }
    .header {
      text-align: center;
      margin-bottom: 20px;
    }
    .header img {
      max-width: 100%;
      height: auto;
      width: 100%; /* Menetapkan lebar gambar agar memenuhi wadahnya */
      max-width: 200px; /* Maksimal lebar gambar */
    }
    .header h1 {
      font-size: 36px; /* Menyesuaikan ukuran font judul */
      margin: 10px 0;
    }
    .content table {
      width: 100%;
      border-collapse: collapse;
    }
    .content table td {
      padding: 8px;
      border: 1px solid #ddd;
    }
    .content h5 {
      margin-top: 0;
    }
    .footer {
      text-align: center;
      margin-top: 20px;
    }
    .qr-code {
      text-align: center;
      margin-top: 20px;
    }
  </style>
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <div class="container">
    <div class="header">
      <img src="{{ asset('logo/TPKS.png') }}" alt="Company Logo">
      <h1>Work Permit</h1>
    </div>
    <div class="content">
      <table>
        <tr>
          <td width="50%">Nama Pekerjaan:</td>
          <td width="50%">{{ $job->job_name }}</td>
        </tr>
        <tr>
          <td width="50%">Nama Perusahaan:</td>
          <td width="50%">{{ $job->user->name }}</td>
        </tr>
        <tr>
          <td width="50%">Tanggal Mulai Kerja:</td>
          <td width="50%">{{ \Carbon\Carbon::parse($job->start_work)->locale('id')->translatedFormat('l, d F Y') }}</td>
        </tr>
        <tr>
          <td width="50%">Tanggal Akhir Kerja:</td>
          <td width="50%">{{ \Carbon\Carbon::parse($job->end_work)->locale('id')->translatedFormat('l, d F Y') }}</td>
        </tr>
        <tr>
          <td width="50%">Jangka Waktu:</td>
          <td width="50%">
            @if($job->end_work && $job->start_work)
              @php
                $start = \Carbon\Carbon::parse($job->start_work);
                $end = \Carbon\Carbon::parse($job->end_work);
                $duration = $end->diffInDays($start);
              @endphp
              {{ $duration }} hari
            @endif
          </td>
        </tr>
        <tr>
          <td width="50%">Nomor Pekerjaan:</td>
          <td width="50%">{{ $job->job_no }}</td>
        </tr>
      </table>
      <br>
      <table>
        <tr>
          <td width="50%">
            <h5>Daftar Anggota</h5>
            <ul>
              @foreach($persons as $person)
                <li>{{ $person->name }}</li>
              @endforeach
            </ul>
          </td>
          <td width="50%">
            <h5>Daftar Alat</h5>
            <ul>
              @foreach($tools as $tool)
                <li>{{ $tool->name }}</li>
              @endforeach
            </ul>
          </td>
        </tr>
      </table>
    </div>
    <div class="qr-code">
      {!! QrCode::size(200)->generate(Request::url()); !!}
      <p>Scan me to return to the origin page</p>
    </div>
    <div class="footer">
      <p>Terminal Petikemas Semarang</p>
      <p>Jl. Coaster No. 10A Semarang Jawa Tengah - 50174</p>
    </div>
  </div>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<script>
  window.addEventListener("load", function() {
    window.print();
  });
</script>
</body>
</html>
