<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Beranda</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            min-height: 100vh;
            background: linear-gradient(180deg, #87CEEB 0%, #5EC8E8 35%, #2E9CCA 60%, #1E7BA8 100%);
            position: relative;
            overflow-x: hidden;
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
            z-index: 1;
        }

        @keyframes waveMove {
            0% { background-position-x: 0; }
            100% { background-position-x: -1200px; }
        }

        .bubble {
            position: fixed;
            bottom: -50px;
            background: rgba(255, 255, 255, 0.35);
            border-radius: 50%;
            animation: rise linear infinite;
            z-index: 1;
        }

        @keyframes rise {
            0% { transform: translateY(0); opacity: 0.8; }
            100% { transform: translateY(-110vh) translateX(20px); opacity: 0; }
        }

        /* Navbar atas */
        .navbar {
            position: relative;
            z-index: 10;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 40px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
        }

        .navbar .logo {
            color: #fff;
            font-size: 20px;
            font-weight: 700;
        }

        .navbar .nav-links {
            display: flex;
            gap: 25px;
            align-items: center;
        }

        .navbar .nav-links a {
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            opacity: 0.9;
        }

        .navbar .nav-links a:hover { opacity: 1; }

        .navbar form button {
            background: rgba(255,255,255,0.25);
            border: none;
            color: #fff;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }

        /* Konten utama */
        .container {
            position: relative;
            z-index: 5;
            max-width: 900px;
            margin: 0 auto;
            padding: 50px 20px 180px;
        }

        .hero {
            text-align: center;
            color: #fff;
            margin-bottom: 40px;
        }

        .hero .icon { font-size: 45px; margin-bottom: 10px; }
        .hero h1 { font-size: 28px; margin-bottom: 6px; }
        .hero p { font-size: 14px; opacity: 0.9; }

        /* Kartu info */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 30px;
        }

        .info-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            border: 2px solid rgba(255, 255, 255, 0.5);
        }

        .info-card .label {
            font-size: 12px;
            color: #5EC8E8;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .info-card .value {
            font-size: 15px;
            color: #1E7BA8;
            font-weight: 700;
            word-break: break-word;
        }

        /* Menu shortcut */
        .menu-title {
            color: #fff;
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 14px;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 14px;
        }

        .menu-item {
            background: rgba(255, 255, 255, 0.85);
            border-radius: 14px;
            padding: 22px 14px;
            text-align: center;
            text-decoration: none;
            border: 2px solid rgba(255, 255, 255, 0.5);
            transition: transform 0.15s;
        }

        .menu-item:hover { transform: translateY(-3px); }

        .menu-item .emoji { font-size: 28px; margin-bottom: 8px; display: block; }
        .menu-item span.label { color: #1E7BA8; font-size: 13px; font-weight: 600; }
    </style>
</head>
<body>

    <div class="wave"></div>

    <nav class="navbar">
        <div class="logo">🏖️ PKL Login App</div>
        <div class="nav-links">
            <a href="/dashboard">Beranda</a>
            <form method="POST" action="/logout" style="margin:0;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container">
        <div class="hero">
            <div class="icon">🌊</div>
            <h1>Selamat datang, {{ Auth::user()->name }}!</h1>
            <p>{{ now()->translatedFormat('l, d F Y - H:i:s') }}</p>
        </div>

        <div class="info-grid">
            <div class="info-card">
                <div class="label">ID User</div>
                <div class="value">{{ Auth::user()->id }}</div>
            </div>
            <div class="info-card">
                <div class="label">Email</div>
                <div class="value">{{ Auth::user()->email }}</div>
            </div>
            <div class="info-card">
                <div class="label">Bergabung Sejak</div>
                <div class="value">{{ Auth::user()->created_at->format('d M Y') }}</div>
            </div>
        </div>
    </div>

    <script>
        function createBubble() {
            const bubble = document.createElement('div');
            bubble.classList.add('bubble');
            const size = Math.random() * 40 + 10;
            bubble.style.width = size + 'px';
            bubble.style.height = size + 'px';
            bubble.style.left = Math.random() * 100 + 'vw';
            const duration = Math.random() * 6 + 6;
            bubble.style.animationDuration = duration + 's';
            document.body.appendChild(bubble);
            setTimeout(() => bubble.remove(), duration * 1000);
        }
        setInterval(createBubble, 400);
    </script>

</body>
</html>