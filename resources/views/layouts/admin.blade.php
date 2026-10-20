<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Admin</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            padding: 24px 16px;
            color: #244657;
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(180deg, #e8f8ff, #d8f0fa);
        }
        main {
            width: min(900px, 100%);
            margin: 0 auto;
            padding: 24px 28px 20px;
            border: 1px solid #d6edf6;
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 8px 28px rgba(30, 123, 168, .12);
        }
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 20px;
        }
        h1 { margin: 0; color: #1e7ba8; font-size: 26px; }
        a { color: #1e7ba8; }
        .actions { display: flex; align-items: center; flex-wrap: wrap; gap: 8px; }
        .button, button {
            display: inline-block;
            padding: 9px 13px;
            border: 0;
            border-radius: 8px;
            color: #fff;
            background: #238eb8;
            font: inherit;
            text-decoration: none;
            cursor: pointer;
        }
        .button.small, button.small { padding: 6px 10px; font-size: 13px; }
        .button.secondary { color: #24566b; background: #e8f4f8; }
        .button.danger, button.danger { background: #c0392b; }
        .flash { margin-bottom: 16px; padding: 12px; border-radius: 8px; }
        .flash.success { color: #17643b; background: #e5f7ec; }
        .flash.error, .validation-errors { color: #922b21; background: #fdecea; }
        .validation-errors { margin-bottom: 16px; padding: 12px 28px; border-radius: 8px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px 8px; border-bottom: 1px solid #e4eef2; text-align: left; }
        th { color: #42758b; }
        form.inline { display: inline; }
        .field { margin-bottom: 16px; }
        label { display: block; margin-bottom: 6px; font-weight: 600; }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #b8dbe8;
            border-radius: 8px;
            font: inherit;
        }
        input:focus { outline: 2px solid #80c9e2; }
        .hint { margin: 5px 0 0; color: #678694; font-size: 13px; }
        .pagination { margin-top: 14px; }
        @media (max-width: 600px) {
            body { padding: 16px 10px; }
            main { padding: 18px 16px 14px; }
            header { align-items: flex-start; flex-direction: column; }
            table { font-size: 14px; }
            th, td { padding: 9px 5px; }
        }
    </style>
</head>
<body>
    <main>
        <header>
            <h1>@yield('heading')</h1>
            <div class="actions">
                <a href="{{ route('admin.dashboard') }}">Dashboard admin</a>
                <a class="button secondary" href="{{ route('admin.users.index') }}">Daftar user</a>
            </div>
        </header>

        @if (session('success'))
            <div class="flash success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="flash error">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <ul class="validation-errors">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        @yield('content')
    </main>
</body>
</html>
