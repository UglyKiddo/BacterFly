<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Inokulasi Bidang {{ $kategori }} - BacterFly</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/manager.css') }}">
</head>
<body>
<div class="container">
    @include('manager.partials.top-bar')

    <main class="report-section">
        <a href="{{ route('manager.pengawasan.inokulasi.index') }}" class="back-btn">Kembali</a>
        <h2>Inokulasi Bidang {{ $kategori }}</h2>

        @forelse ($data as $row)
            <div class="bacteria-item" id="item-{{ $row->inokulasi_id }}">
                @if (!empty($row->foto_bakteri))
                    <img src="{{ asset('asset/foto_bakteriInokulasi/' . $row->foto_bakteri) }}" alt="Foto Bakteri" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                @endif
                <div class="bacteria-info">
                    <p><strong>ID Inokulasi:</strong> {{ $row->inokulasi_id }}</p>
                    <p><strong>Kategori:</strong> {{ $row->kategori }}</p>
                    <p><strong>Nama Bakteri:</strong> {{ $row->nama_bakteri }}</p>
                    <p><strong>Media:</strong> {{ $row->media }}</p>
                    <p><strong>Metode Inokulasi:</strong> {{ $row->metode_inokulasi }}</p>
                    <p><strong>Tanggal Inokulasi:</strong> {{ $row->tanggal_inokulasi }}</p>
                    <p><strong>Jumlah Bakteri:</strong> {{ $row->jumlah_bakteri }}</p>
                    <p><strong>Status Kualitas:</strong> {{ $row->status_b }}</p>
                    <p><strong>Tanggal Keluar:</strong> {{ $row->tanggal_keluar }}</p>
                </div>
            </div>
        @empty
            <p style="text-align:center;">Tidak ada data inokulasi.</p>
        @endforelse
    </main>

    @include('manager.partials.navbar')
</div>
</body>
</html>
