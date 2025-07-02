<!-- Tampilan profil -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil - {{ $user->division }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/lab.css') }}">
</head>
<body>

<header class="top-bar">
    <div class="logo">
        <img src="{{ asset('logo.png') }}" alt="Logo BacterFly">
        <span>Welcome To <strong>BacterFly</strong></span>
    </div>
    <div class="nav-bar">
        <span class="title">Profil</span>
    </div>
</header>

<main class="profile-container">
    <div class="avatar">
        <img src="{{ $fotoPath }}" alt="Foto Profil" />
    </div>

    <h2 class="username">{{ $user->nama }}</h2>

    <div class="edit-container">
        <a href="{{ route('lab.profil.edit') }}" class="edit-btn">Ubah</a>
    </div>

    <div class="user-info">
        <p>Email: {{ $user->email }}</p>
        <p>Divisi: {{ $user->division }}</p>
    </div>
</main>



@include('lab.partials.navbar')

</body>
</html>
