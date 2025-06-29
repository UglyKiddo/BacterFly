<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajer - BacterFly</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/manager.css') }}">
</head>
<body>
<div class="container">
    <header class="top-bar">
        <div class="logo">
            <img src="{{ asset('logo.png') }}" alt="BacterFly Logo">
            <span>Welcome To <strong>BacterFly</strong></span>
        </div>
        <div class="division">{{ $divisi }}</div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </header>

    <main>
        <div class="reminder">
            <b>📣 Pengingat</b><br>
            Anda sedang di Beranda
        </div>
    </main>

  @include('manager.partials.navbar')
</div>
</body>
</html>
