<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil - BacterFly</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/manager.css') }}">
</head>
<body>

    <header class="top-bar">
        <div class="logo">
            <img src="{{ asset('logo.png') }}" alt="Logo BacterFly">
             <span>Edit <strong>Profil</strong></span>
        </div>
    </header>

    <main class="profile-container">
        <div class="avatar">
            <img src="{{ $fotoPath }}" alt="Foto Saat Ini">
        </div>

        <div class="form-container">
            @if (session('success'))
                <p class="message">{{ session('success') }}</p>
            @endif

            <form method="POST" action="{{ route('manager.profil.update') }}" enctype="multipart/form-data">
                @csrf

                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $user->nama) }}" required>

                <label for="division">Divisi</label>
                <input type="text" name="division" id="division" value="{{ old('division', $user->division) }}">

                <label for="foto">Foto Profil</label>
                <input type="file" name="foto" accept="image/*">

               <div class="button-group">
                    <button type="button" class="btn-cancel" onclick="window.location='{{ route('manager.profil') }}'">Kembali</button>
                    <button type="submit">Simpan</button>
                </div>

            </form>
        </div>
    </main>

</body>
</html>
