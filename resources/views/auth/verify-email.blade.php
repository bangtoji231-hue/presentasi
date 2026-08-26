<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Email</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(180deg, #87CEEB 0%, #5EC8E8 35%, #2E9CCA 60%, #1E7BA8 100%);
            overflow: hidden;
            position: relative;
        }

        .wave {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 150px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 150' preserveAspectRatio='none'%3E%3Cpath d='M0,80 C200,140 400,20 600,80 C800,140 1000,20 1200,80 L1200,150 L0,150 Z' fill='%23F5E6C8'/%3E%3C/svg%3E") repeat-x;
            background-size: 1200px 150px;
            animation: waveMove 10s linear infinite;
        }

        @keyframes waveMove {
            0% { background-position-x: 0; }
            100% { background-position-x: -1200px; }
        }

        .card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            padding: 40px 35px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 60, 90, 0.3);
            width: 380px;
            text-align: center;
            position: relative;
            z-index: 10;
            border: 2px solid rgba(255, 255, 255, 0.5);
        }

        .icon { font-size: 50px; margin-bottom: 10px; }
        h2 { color: #1E7BA8; margin-bottom: 12px; }
        p { color: #2E7A9C; font-size: 14px; margin-bottom: 20px; line-height: 1.6; }

        .message {
            background: #E6F9EE;
            border-left: 4px solid #27AE60;
            padding: 10px 12px;
            border-radius: 6px;
            margin-bottom: 15px;
            color: #1E7B44;
            font-size: 13px;
            text-align: left;
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #2E9CCA, #1E7BA8);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .logout-btn {
            background: transparent;
            color: #E74C3C;
            border: none;
            font-size: 13px;
            cursor: pointer;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="wave"></div>

    <div class="card">
        <div class="icon">📩</div>
        <h2>Cek Email Kamu</h2>
        <p>
            Terima kasih sudah mendaftar! Kami sudah kirim link verifikasi ke email kamu.
            Klik link itu untuk mengaktifkan akun sebelum masuk ke dashboard.
        </p>

        @if (session('message'))
            <div class="message">{{ session('message') }}</div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit">Kirim Ulang Link Verifikasi</button>
        </form>

        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

</body>
</html>