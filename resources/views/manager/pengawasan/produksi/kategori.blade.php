<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Produksi Bidang {{ $kategori }} - BacterFly</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/manager.css') }}">
</head>
<body>
<div class="container">
    @include('manager.partials.top-bar')

    <main class="report-section">
        <a href="{{ route('manager.pengawasan.produksi.index') }}" class="back-btn">Kembali</a>
        <h2>Produksi Bidang {{ $kategori }}</h2>

        @forelse ($data as $row)
            <div class="bacteria-item">
                @if ($row->foto_bakteri)
                    <img src="{{ asset('asset/foto_bakteriProduksi/' . $row->foto_bakteri) }}" alt="Foto Bakteri" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                @endif
                <div class="bacteria-info">
                    <p><strong>ID:</strong> {{ $row->p_id }}</p>
                    <p><strong>Nama:</strong> {{ $row->nama_bakteri }}</p>
                    <p><strong>Media:</strong> {{ $row->media }}</p>
                    <p><strong>Metode:</strong> {{ $row->metode_produksi }}</p>
                    <p><strong>Tgl Masuk:</strong> {{ $row->tanggal_masuk }}</p>
                    <p><strong>Stok:</strong> {{ $row->jumlah_masuk }}</p>
                    <p><strong>Digunakan:</strong> {{ $row->jumlah_keluar }}</p>
                    <p><strong>Status:</strong> {{ $row->status_perkembangan }}</p>
                    <p><strong>Tgl Keluar:</strong> {{ $row->tanggal_keluar }}</p>
                </div>
            </div>
        @empty
            <p style="text-align:center;">Tidak ada data produksi.</p>
        @endforelse
    </main>

    @include('manager.partials.navbar')
</div>
</body>
</html>
