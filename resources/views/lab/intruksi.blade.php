<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instruksi - BacterFly</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Segoe+UI:wght@400;700&display=swap">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #000;
            color: #fff;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-size: 16px;
        }

        .top-bar {
            padding: 10px;
            background-color: #000;
            border-bottom: 1px solid #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #FF8C42;
            font-size: 14px;
            font-family: 'Courier New', monospace;
        }

        .logo span strong {
            color: #fff;
        }

        .division {
            margin-top: 5px;
            font-size: 14px;
            color: #fff;
        }

        .logout-btn {
            background-color: #FF4500;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s, transform 0.2s;
            position: absolute;
            top: 16px;
            right: 16px;
        }

        .logout-btn:hover {
            background-color: #FF6347;
            transform: scale(1.05);
        }

        .logout-btn:active {
            background-color: #E03A2E;
            transform: scale(0.98);
        }

        main {
            flex: 1;
            padding: 16px;
        }

        .reminder {
            background-color: #800080;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 20px;
        }

        .instructions-list {
            margin-bottom: 20px;
        }

        .instruction-item {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .instruction-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .instruction-details {
            font-size: 12px;
            color: #aaa;
        }

        .instruction-status {
            margin-top: 5px;
            font-size: 13px;
        }

        .instruction-status.done {
            color: #0f0;
        }

        .actions {
            margin-top: 10px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .actions a {
            text-decoration: none;
            padding: 6px 10px;
            border-radius: 5px;
            font-size: 14px;
            color: white;
        }

        .detail {
            background-color: #FFA500;
        }

        .delete {
            background-color: #FF4500;
        }

        .done {
            background-color: #32CD32;
        }

        .done.completed {
            background-color: #808080;
            pointer-events: none;
        }

        .bottom-nav {
            display: flex;
            justify-content: space-around;
            background: #000;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.5);
            border-top: 1px solid #555;
        }

        .bottom-nav a {
            color: #fff;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 12px;
            transition: transform 0.2s, opacity 0.2s, color 0.2s;
        }

        .bottom-nav a span {
            margin-top: 2px;
        }

        .bottom-nav a:hover,
        .bottom-nav a.active {
            color: #FF8C42;
        }

        .bottom-nav a:hover span,
        .bottom-nav a.active span {
            transform: scale(1.2);
        }

        @media (max-width: 600px) {
            .top-bar {
                padding: 8px;
            }

            .logo {
                font-size: 12px;
            }

            .division {
                font-size: 12px;
            }

            .logout-btn {
                padding: 6px 12px;
                font-size: 12px;
                top: 12px;
                right: 12px;
            }

            main {
                padding: 12px;
            }

            .bottom-nav a {
                font-size: 10px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <header class="top-bar">
        <div class="logo">
            <span>Welcome To <strong>Bacter</strong>Fly</span>
        </div>
        <div class="division">{{ $divisi }}</div>

        {{-- Logout form --}}
        <form action="{{ route('logout') }}" method="POST" style="position: absolute; top: 16px; right: 16px;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </header>

    <main>
        <h2 style="padding: 0 10px;">Instruksi</h2>

        @if($instructions->isEmpty())
            <div class="reminder">
                Pesan !! Tidak ada instruksi yang diberikan!!
            </div>
        @endif

        <div class="instructions-list">
            @foreach($instructions as $row)
                <div class="instruction-item">
                    <p class="instruction-title">{{ $row->title }}</p>
                    <p class="instruction-details">
                        Dibuat pada: {{ \Carbon\Carbon::parse($row->created_at)->format('d/m/Y H:i') }}
                    </p>
                    <span class="instruction-status {{ $row->status === 'done' ? 'done' : '' }}">
                        [Status: {{ $row->status ?? 'pending' }}]
                    </span>
                    <div class="actions">
                        <a href="{{ url('lab/instruksi/detail/'.$row->id) }}" class="detail">Lihat Detail</a>
                        <a href="{{ url('lab/instruksi/done/'.$row->id) }}" class="done {{ $row->status === 'done' ? 'completed' : '' }}">Selesai</a>
                        <a href="{{ url('lab/instruksi/delete/'.$row->id) }}" class="delete">Hapus</a>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <div class="bottom-nav">
        <a href="{{ route('lab.dashboard') }}">
            <span>🏠</span>
            <span>Home</span>
        </a>
        <a href="{{ route('lab.bakteri.index') }}">
            <span>🕒</span>
            <span>Data</span>
        </a>
        <a href="{{ route('lab.intruksi') }}" class="active">
            <span>📋</span>
            <span>Instruksi</span>
        </a>
        <a href="{{ route('lab.profil') }}">
            <span>👤</span>
            <span>Profil</span>
        </a>
    </div>
</div>
</body>
</html>