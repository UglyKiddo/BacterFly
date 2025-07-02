<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tim Produksi - Pilih Kategori Bakteri</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/pro.css') }}">
</head>
<body>
<div class="container">
      <div class="top-bar">
        <div class="logo">
            <img src="{{ asset('logo.png') }}" alt="Logo">
           <span>Welcome To <strong>BacterFly</strong></span>
        </div>
        <div class="division">{{ Auth::user()->division }}</div>
      </div>
    <main>
        <h2 style="text-align:center; margin-top: 20px;">Pilih Kategori Produksi</h2>

        <div class="grid">
            <a href="{{ route('produksi.probakteri.kategori', 'Peternakan') }}" class="card">
                <img src="{{ asset('asset/peternakan.png') }}" alt="Peternakan" />
                <span>Peternakan</span>
            </a>
            <a href="{{ route('produksi.probakteri.kategori', 'Perikanan') }}" class="card">
                <img src="{{ asset('asset/perikanan.png') }}" alt="Perikanan" />
                <span>Perikanan</span>
            </a>
            <a href="{{ route('produksi.probakteri.kategori', 'Pertanian') }}" class="card">
                <img src="{{ asset('asset/pertanian.png') }}" alt="Pertanian" />
                <span>Pertanian</span>
            </a>
        </div>
    </main>

    @include('produksi.partials.navbar')
</div>
</body>
</html>
