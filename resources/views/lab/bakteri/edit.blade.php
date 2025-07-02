<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Bakteri - {{ $bakteri->kategori }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/lab.css') }}">
</head>
<body class="edit-bakteri-page">
    <div class="top-bar">
        <div class="logo">
            <img src="{{ asset('logo.png') }}" alt="Logo">
            <span>Edit Data - Produksi <strong>BacterFly</strong></span>
        </div>
    </div>

    <form method="POST" action="{{ route('lab.bakteri.update', $bakteri->inokulasi_id) }}" enctype="multipart/form-data" class="edit-form">
        @csrf
        @method('PUT')

        <input type="hidden" name="kategori" value="{{ $bakteri->kategori }}">

        <label>Nama Bakteri</label>
        <input type="text" name="nama_bakteri" value="{{ old('nama_bakteri', $bakteri->nama_bakteri) }}" required>

        <label>Media</label>
        <select name="media" required>
            @foreach (['NA', 'TSA', 'MRSA', 'PDA'] as $m)
                <option value="{{ $m }}" @selected($bakteri->media == $m)>{{ $m }}</option>
            @endforeach
        </select>

        <label>Metode Inokulasi</label>
        <input type="text" name="metode_inokulasi" value="{{ old('metode_inokulasi', $bakteri->metode_inokulasi) }}" required>

        <label>Tanggal Inokulasi</label>
        <input type="date" name="tanggal_inokulasi" value="{{ $bakteri->tanggal_inokulasi }}" required>

        <label>Jumlah Bakteri</label>
        <input type="number" name="jumlah_bakteri" value="{{ $bakteri->jumlah_bakteri }}">

        <label>Status</label>
        <select name="status_b" required>
            @foreach (['gagal', 'proses', 'berhasil'] as $status)
                <option value="{{ $status }}" @selected($bakteri->status_b == $status)>{{ ucfirst($status) }}</option>
            @endforeach
        </select>

        <label>Tanggal Keluar</label>
        <input type="date" name="tanggal_keluar" value="{{ $bakteri->tanggal_keluar }}">

        <label>Foto Bakteri</label>
        <input type="file" name="foto_bakteri" accept="image/*">

        @if ($bakteri->foto_bakteri)
            <p style="margin-top: 10px;">Foto saat ini:</p>
            <img src="{{ asset('asset/foto_bakteriLab/' . $bakteri->foto_bakteri) }}" alt="Foto Bakteri" class="preview">
        @endif

        <div style="margin-top: 20px;">
            <button type="submit">Simpan Perubahan</button>
            <a href="{{ route('lab.bakteri.kategori', $bakteri->kategori) }}" class="btn-cancel">Kembali</a>
        </div>
    </form>
</body>
</html>
