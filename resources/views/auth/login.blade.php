<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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

        /* Gelombang laut di bawah */
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

        /* Gelembung */
        .bubble {
            position: fixed;
            bottom: -50px;
            background: rgba(255, 255, 255, 0.35);
            border-radius: 50%;
            box-shadow: inset -3px -3px 6px rgba(255,255,255,0.4), inset 3px 3px 6px rgba(0,0,0,0.05);
            animation: rise linear infinite;
        }

        @keyframes rise {
            0% {
                transform: translateY(0) translateX(0);
                opacity: 0.8;
            }
            100% {
                transform: translateY(-110vh) translateX(20px);
                opacity: 0;
            }
        }

        /* Kartu login */
        .card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            padding: 40px 35px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 60, 90, 0.3);
            width: 340px;
            position: relative;
            z-index: 10;
            border: 2px solid rgba(255, 255, 255, 0.5);
        }

        .card h2 {
            text-align: center;
            color: #1E7BA8;
            margin-bottom: 5px;
            font-size: 28px;
        }

        .card .subtitle {
            text-align: center;
            color: #5EC8E8;
            font-size: 13px;
            margin-bottom: 25px;
        }

        label {
            display: block;
            color: #2E7A9C;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 4px;
            margin-top: 12px;
        }

        input {
            width: 100%;
            padding: 10px 12px;
            border: 1.5px solid #B8E0F0;
            border-radius: 10px;
            font-size: 14px;
            background: rgba(255, 255, 255, 0.7);
            transition: border 0.2s;
        }

        input:focus {
            outline: none;
            border-color: #2E9CCA;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 22px;
            background: linear-gradient(135deg, #2E9CCA, #1E7BA8);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.15s, box-shadow 0.15s;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(30, 123, 168, 0.4);
        }

        .error {
            background: #FFE8E8;
            border-left: 4px solid #E74C3C;
            padding: 8px 12px;
            border-radius: 6px;
            margin-bottom: 10px;
        }

        .error p {
            color: #C0392B;
            font-size: 12.5px;
        }

        .shell {
            text-align: center;
            font-size: 32px;
            margin-bottom: -5px;
        }
    </style>
</head>
<body>

    <div class="wave"></div>

    <div class="card">
        <div class="shell">🌊</div>
        <h2>Selamat Datang</h2>
        <p class="subtitle">Login untuk melanjutkan</p>

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="/login">
            @csrf
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autofocus>

            <label>Password</label>
            <input type="password" name="password" placeholder="••••••••" required>

            <label style="display:flex; align-items:center; gap:6px; font-weight:400; margin-top:12px;">
    <input type="checkbox" name="remember" style="width:auto;">
    Ingat saya
</label>
            <button type="submit">Masuk 🏖️</button>
        </form>
    </div>

    <script>
        // Bikin gelembung otomatis
        function createBubble() {
            const bubble = document.createElement('div');
            bubble.classList.add('bubble');

            const size = Math.random() * 40 + 10; // 10px - 50px
            bubble.style.width = size + 'px';
            bubble.style.height = size + 'px';
            bubble.style.left = Math.random() * 100 + 'vw';

            const duration = Math.random() * 6 + 6; // 6-12 detik
            bubble.style.animationDuration = duration + 's';

            document.body.appendChild(bubble);

            setTimeout(() => bubble.remove(), duration * 1000);
        }

        setInterval(createBubble, 400);
    </script>

</body>
</html>