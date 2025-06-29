<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengawasan Inokulasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/manager.css') }}">
</head>
<body>
<div class="container">
    @include('manager.partials.top-bar')

    <main>
        <h2 style="text-align:center; margin-top: 20px;">Pilih Kategori Inokulasi</h2>  
        <div class="grid">
            <div class="card" onclick="location.href='{{ route('manager.pengawasan.inokulasi.kategori', 'Peternakan') }}'">
                <img src="{{ asset('asset/peternakan.png') }}" alt="Peternakan">
                <span>Peternakan</span>
            </div>
            <div class="card" onclick="location.href='{{ route('manager.pengawasan.inokulasi.kategori', 'Pertanian') }}'">
                <img src="{{ asset('asset/pertanian.png') }}" alt="Pertanian">
                <span>Pertanian</span>
            </div>
            <div class="card" onclick="location.href='{{ route('manager.pengawasan.inokulasi.kategori', 'Perikanan') }}'">
                <img src="{{ asset('asset/perikanan.png') }}" alt="Perikanan">
                <span>Perikanan</span>
            </div>
        </div>
    </main>

    @include('manager.partials.navbar')
</div>
</body>
</html>
