<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .email-header {
            background-color: #007bff;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            font-size: 24px;
        }
        .email-body {
            padding: 20px;
            color: #333333;
            line-height: 1.6;
        }
        .email-body p {
            margin: 10px 0;
        }
        .email-footer {
            background-color: #f4f4f4;
            color: #666666;
            text-align: center;
            padding: 10px;
            font-size: 12px;
            border-top: 1px solid #dddddd;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .button:hover {
            background-color: #218838;
        }
        .table-info {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .table-info td {
            padding: 8px;
            border: 1px solid #dddddd;
        }
        .table-info td:first-child {
            font-weight: bold;
            background-color: #f9f9f9;
            width: 40%;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            Kesepakatan Izin Kerja
        </div>
        <div class="email-body">
            <h2>Dear. HSSE</h2>
            <p>Kesepakatan Penentuan Tanggal Rapat Izin Kerja {{ $company }}. Berikut detailnya:</p>

            <table class="table-info">
                <tr>
                    <td>Nama Perusahaan</td>
                    <td>{{ $company }}</td>
                </tr>
                <tr>
                    <td>Nama Pemilik</td>
                    <td>{{ $name }}</td>
                </tr>
                <tr>
                    <td>NPWP</td>
                    <td>{{ $npwp }}</td>
                </tr>
                <tr>
                    <td>NO Handphone</td>
                    <td>{{ $nohp }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $email }}</td>
                </tr>

                <tr>
                    <td>Nama Pekerjaan</td>
                    <td>{{ $job_name }}</td>
                </tr>
                <tr>
                    <td>Nomor Pekerjaan</td>
                    <td>{{ $job_no }}</td>
                </tr>
                <tr>
                    <td>Lokasi</td>
                    <td>{{ $location }}</td>
                </tr>
                <tr>
                    <td>Area</td>
                    <td>{{ $area }}</td>
                </tr>
                <tr>
                    <td>Tanggal Mulai Pekerjaan</td>
                    <td>{{ \Carbon\Carbon::parse($job->start_work)->locale('id')->translatedFormat('l, d F Y') }}</td>
                </tr>
                <tr>
                    <td>Tanggal Akhir Pekerjaan</td>
                    <td>{{ \Carbon\Carbon::parse($job->end_work)->locale('id')->translatedFormat('l, d F Y') }}</td>
                </tr>

                <tr>
                    <td>Tanggal Bertemu</td>
                    <td>{{ $meetingDate ? \Carbon\Carbon::parse($meetingDate)->locale('id')->translatedFormat('l, d F Y') : '-' }}</td>
                </tr>
                <tr>
                    <td>Keterangan</td>
                    <td>{{ $description ?: '-' }}</td>
                </tr>
            </table>

            <p>Regards, Fungsional</p>

            <a href="http://localhost/work_permit/job_desc" class="button">Lihat Detail</a>
        </div>
        <div class="email-footer">
            &copy; 2024 Pelindo Terminal Petikemas Semarang. Semua hak dilindungi undang-undang.
        </div>
    </div>
</body>
</html>
