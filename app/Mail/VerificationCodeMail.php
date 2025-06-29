<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kode Verifikasi Anda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            color: #333;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            border-radius: 8px;
            padding: 30px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .code {
            font-size: 24px;
            font-weight: bold;
            background-color: #ff6200;
            color: #fff;
            padding: 10px 20px;
            display: inline-block;
            margin: 20px 0;
            border-radius: 5px;
        }
        p {
            margin: 0 0 10px;
            line-height: 1.5;
        }
        .footer {
            margin-top: 20px;
            font-size: 13px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Halo!</h2>
        <p>Terima kasih telah mendaftar di <strong>BacterFly</strong>.</p>
        <p>Kode verifikasi Anda adalah:</p>
        <div class="code">{{ $code }}</div>
        <p>Silakan masukkan kode ini pada halaman pendaftaran untuk menyelesaikan proses verifikasi email Anda.</p>
        <p>Jika Anda tidak meminta kode ini, abaikan email ini.</p>

        <div class="footer">
            &copy; {{ date('Y') }} BacterFly. All rights reserved.
        </div>
    </div>
</body>
</html>
