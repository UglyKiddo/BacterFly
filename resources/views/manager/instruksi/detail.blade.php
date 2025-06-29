<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Instruksi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/manager.css') }}">
</head>
<body>
<div class="container">
    @include('manager.partials.top-bar')

    <main class="profile-container">
        <h2>{{ $instruksi->title }}</h2>
        <p><strong>Divisi:</strong> {{ $instruksi->division }}</p>
        <p><strong>Status:</strong> {{ $instruksi->status }}</p>
        <p><strong>Isi Instruksi:</strong></p>
        <div class="user-info">
            <p>{{ $instruksi->content }}</p>
        </div>
        <br>
        <a href="{{ route('manager.instruksi') }}" class="btn-cancel">Kembali ke Daftar</a>
    </main>

    @include('manager.partials.navbar')
</div>
</body>
</html>
