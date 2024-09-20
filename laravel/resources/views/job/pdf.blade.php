<!DOCTYPE html>
<html>
<head>
    <title>Work Permit | Monic</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 0; 
            padding: 0; 
            background-color: #f4f4f4; 
        }
        .container { 
            width: 100%; 
            max-width: 800px; 
            margin: 20px auto; 
            padding: 20px; 
            background-color: #fff; 
            border-radius: 8px; 
            box-shadow: 0 0 10px rgba(0,0,0,0.1); 
        }
        .header { 
            text-align: center; 
            margin-bottom: 30px; 
            border-bottom: 2px solid #007bff; 
            padding-bottom: 10px; 
        }
        .header img { 
            max-width: 150px; 
            margin-bottom: 10px; 
        }
        .header h1 { 
            margin: 0; 
            color: #007bff; 
            font-size: 24px; 
        }
        .content { 
            margin-top: 20px; 
        }
        .content table { 
            width: 100%; 
            border-collapse: collapse; 
        }
        .content table, 
        .content th, 
        .content td { 
            border: 1px solid #ddd; 
        }
        .content th, 
        .content td { 
            padding: 12px; 
            text-align: left; 
        }
        .content th { 
            background-color: #007bff; 
            color: #fff; 
        }
        .content tr:nth-child(even) { 
            background-color: #f9f9f9; 
        }
        .footer { 
            text-align: center; 
            margin-top: 30px; 
            font-size: 12px; 
            color: #666; 
        }
        .list-section h5 {
            margin-bottom: 10px;
            color: #007bff;
        }
        .list-section ul {
            list-style-type: none;
            padding: 0;
        }
        .list-section ul li {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{asset('logo/TPKS.png')}}" alt="Company Logo"> <!-- Tambahkan logo perusahaan -->
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
                                $duration = $end->diffInDays($start); // Menghitung durasi dalam hari
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
        <div class="footer">
            <p>Terminal Petikemas Semarang</p>
            <p>Jl. Coaster No. 10A Semarang Jawa Tengah - 50174</p>
        </div>
    </div>

    <!-- pdf -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
