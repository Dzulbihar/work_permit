<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Request</title>
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
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            Permintaan Pengajuan Izin Kerja
        </div>
        <div class="email-body">
            <h2>Halo,</h2>
            <p>Permintaan Pengajuan izin kerja. Berikut detailnya:</p>
            <p><strong>Nama Perusahaan:</strong> {{ $jobPT }}</p>
            <p><strong>Nama Pekerjaan:</strong> {{ $jobName }}</p>
            <p><strong>Deskripsi Pekerjaan:</strong> {{ $jobDesc }}</p>

            <p><strong>Tanggal Mulai Pekerjaan:</strong> {{ \Carbon\Carbon::parse($job->start_work)->locale('id')->translatedFormat('l, d F Y') }}</p>
            <p><strong>Tanggal Akhir Pekerjaan:</strong> {{ \Carbon\Carbon::parse($job->end_work)->locale('id')->translatedFormat('l, d F Y') }} </p>
            

            <a href="#" class="button">Lihat Detail</a>
        </div>
        <div class="email-footer">
            &copy; 2024 Pelindo Terminal Petikemas Semarang. Semua hak dilindungi undang-undang.
        </div>
    </div>
</body>
</html>
