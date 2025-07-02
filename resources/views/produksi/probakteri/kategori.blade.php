<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Produksi - {{ $kategori }}</title>
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
        <button onclick="window.location='{{ route('produksi.probakteri.index') }}'" class="kback-btn">⬅ Kembali</button>
        <h2 style="text-align:center; margin: 15px ;">Data Bakteri - {{ $kategori }}</h2>
        @if (session('success'))
            <p class="message">{{ session('success') }}</p>
        @endif

        @if ($data->isEmpty())
            <div class="reminder">Belum ada data bakteri untuk kategori ini.</div>
        @else
            @foreach ($data as $item)
                <div class="bacteria-item" id="item-{{ $item->p_id }}">
                    @if ($item->foto_bakteri)
                        <img src="{{ asset('asset/foto_bakteriProduksi/' . $item->foto_bakteri) }}" alt="Foto Bakteri">
                    @endif

                    <div class="bacteria-info">
                        <p><strong>Nama:</strong> {{ $item->nama_bakteri }}</p>
                        <p><strong>Media:</strong> {{ $item->media }}</p>
                        <p><strong>Metode:</strong> {{ $item->metode_produksi }}</p>
                        <p><strong>Tanggal Masuk:</strong> {{ $item->tanggal_masuk }}</p>
                        <p><strong>Stok:</strong> {{ $item->jumlah_masuk }}</p>
                        <p><strong>Keluar:</strong> {{ $item->jumlah_keluar }}</p>
                        <p><strong>Status:</strong> {{ $item->status_perkembangan }}</p>
                        <p><strong>Tanggal Keluar:</strong> {{ $item->tanggal_keluar }}</p>
                    </div>

                    <div class="action-buttons">
                        <a href="{{ route('produksi.probakteri.edit', $item->p_id) }}">✏️ Edit</a>

                        <form action="{{ route('produksi.probakteri.destroy', $item->p_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus data ini?')">🗑️ Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif

        <div style="text-align:center; margin-top: 20px;">
            <a href="{{ route('produksi.probakteri.create', ['kategori' => $kategori]) }}"
               style="background:#FFA347; color:black; padding:10px 20px; border-radius:5px; border:1px solid black; text-decoration:none;">
                ➕ Tambah
            </a>
        </div>
    </main>

    @include('produksi.partials.navbar')
</div>
</body>
</html>
