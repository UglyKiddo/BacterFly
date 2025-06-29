<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengawasan - BacterFly</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/manager.css') }}">
</head>
<body>
    <div class="container">
        @include('manager.partials.top-bar')

       <main>
            <h2 style="text-align:center; margin-top: 20px;">Pilih Laporan Divisi</h2>

            <div class="division-buttons">
                <a href="{{ route('manager.pengawasan.produksi.index') }}" class="division-card">
                    <img src="{{ asset('asset/produksi.png') }}" alt="Produksi">Produksi
                </a>
                <a href="{{ route('manager.pengawasan.inokulasi.index') }}" class="division-card">
                    <img src="{{ asset('asset/lab.png') }}" alt="Inokulasi">Inokulasi
                </a>
            </div>
        </main>

        @include('manager.partials.navbar')
    </div>
</body>
</html>
