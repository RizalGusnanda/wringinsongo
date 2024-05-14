<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email dari Form Kontak</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .email-container {
            background-color: #ffffff;
            padding: 20px;
            margin: 20px auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            max-width: 600px;
        }
        .header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: #ffffff;
            padding: 20px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 20px;
            text-align: left;
            line-height: 1.6;
        }
        .content p {
            margin: 10px 0;
        }
        .footer {
            font-size: 14px;
            color: #777;
            padding: 12px 20px;
            background-color: #f8f9fa;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Kontak Wisata Wringinsongo</h1>
        </div>
        <div class="content">
            <p><strong>Nama:</strong> {{ $nama }}</p>
            <p><strong>Email:</strong> {{ $email }}</p>
            <p><strong>Pesan:</strong> {{ $pesan }}</p>
        </div>
        <div class="footer text-center">
            Email ini dibuat secara otomatis, mohon tidak membalas langsung ke email ini.
        </div>
    </div>
</body>
</html>
