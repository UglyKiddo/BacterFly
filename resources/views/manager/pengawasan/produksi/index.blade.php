<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Produksi - Pengawasan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/manager.css') }}">
</head>
<body>
<div class="container">
    @include('manager.partials.top-bar')

    <main>
        <h2 style="text-align:center; margin-top: 20px;">Pilih Kategori Produksi</h2>

        <div class="grid">
            <a href="{{ route('manager.pengawasan.produksi.kategori', 'Peternakan') }}" class="card">
                <img src="{{ asset('asset/peternakan.png') }}" alt="Peternakan" />
                <span>Peternakan</span>
            </a>
            <a href="{{ route('manager.pengawasan.produksi.kategori', 'Perikanan') }}" class="card">
                <img src="{{ asset('asset/perikanan.png') }}" alt="Perikanan" />
                <span>Perikanan</span>
            </a>
            <a href="{{ route('manager.pengawasan.produksi.kategori', 'Pertanian') }}" class="card">
                <img src="{{ asset('asset/pertanian.png') }}" alt="Pertanian" />
                <span>Pertanian</span>
            </a>
        </div>
    </main>

    @include('manager.partials.navbar')
</div>
</body>
</html>
