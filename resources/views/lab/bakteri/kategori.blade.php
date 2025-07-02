<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Bakteri - {{ $kategori }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/pro.css') }}">
</head>
<body>
<div class="container">
    <header class="top-bar">
        <div class="logo">
            <img src="{{ asset('logo.png') }}" alt="Logo">
            <span>Laporan <strong>Bakteri</strong> - {{ $kategori }}</span>
        </div>
        <div class="division">{{ Auth::user()->division }}</div>
    </header>

    <main class="report-section">
        <button onclick="window.location='{{ route('lab.bakteri.index') }}'" class="kback-btn">⬅ Kembali</button>
        <h2 style="text-align:center; margin: 15px;">Data Bakteri - {{ $kategori }}</h2>

        @if (session('success'))
            <p class="message">{{ session('success') }}</p>
        @endif

        @if ($data->isEmpty())
            <div class="reminder">Belum ada data bakteri untuk kategori ini.</div>
        @else
            @foreach ($data as $item)
                <div class="bacteria-item" id="item-{{ $item->inokulasi_id }}">
                    @if ($item->foto_bakteri)
                        <img src="{{ asset('foto_bakteriLab/' . $item->foto_bakteri) }}" alt="Foto Bakteri">
                    @endif

                    <div class="bacteria-info">
                        <p><strong>Nama:</strong> {{ $item->nama_bakteri }}</p>
                        <p><strong>Media:</strong> {{ $item->media }}</p>
                        <p><strong>Metode Inokulasi:</strong> {{ $item->metode_inokulasi }}</p>
                        <p><strong>Tanggal Inokulasi:</strong> {{ $item->tanggal_inokulasi }}</p>
                        <p><strong>Jumlah Bakteri:</strong> {{ $item->jumlah_bakteri }}</p>
                        <p><strong>Status:</strong> {{ ucfirst($item->status_b) }}</p>
                        <p><strong>Tanggal Keluar:</strong> {{ $item->tanggal_keluar }}</p>
                    </div>

                    <div class="action-buttons">
                        <a href="{{ route('lab.bakteri.edit', $item->inokulasi_id) }}">✏️ Edit</a>

                        <form action="{{ route('lab.bakteri.destroy', $item->inokulasi_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus data ini?')">🗑️ Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif

        <div style="text-align:center; margin-top: 20px;">
            <a href="{{ route('lab.bakteri.create', ['kategori' => $kategori]) }}"
               style="background:#FFA347; color:black; padding:10px 20px; border-radius:5px; border:1px solid black; text-decoration:none;">
                ➕ Tambah
            </a>
        </div>
    </main>

    @include('lab.partials.navbar') {{-- Sesuaikan juga partial jika sebelumnya pakai "produksi" --}}
</div>
</body>
</html>