<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Bakteri - {{ $kategori }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/lab.css') }}">
</head>
<body class="tambah-bakteri-page">
    <div class="top-bar">
        <div class="logo">
            <img src="{{ asset('logo.png') }}" alt="Logo">
            <span>Tambah Data - Produksi <strong>BacterFly</strong></span>
        </div>
    </div>
    <main class="edit-form">
        <form method="POST" action="{{ route('lab.bakteri.store') }}" enctype="multipart/form-data" class="edit-form">
            @csrf
            <input type="hidden" name="kategori" value="{{ $kategori }}">

            <label>Nama Bakteri</label>
            <input type="text" name="nama_bakteri" required>

            <label>Media</label>
            <select name="media" required>
                <option value="NA">NA</option>
                <option value="TSA">TSA</option>
                <option value="MRSA">MRSA</option>
                <option value="PDA">PDA</option>
            </select>

            <label>Metode Inokulasi</label>
            <input type="text" name="metode_inokulasi" required>

            <label>Tanggal Inokulasi</label>
            <input type="date" name="tanggal_inokulasi" required>

            <label>Jumlah Bakteri</label>
            <input type="number" name="jumlah_bakteri">

            <label>Status</label>
            <select name="status_b" required>
                <option value="gagal">Gagal</option>
                <option value="proses">Proses</option>
                <option value="berhasil">Berhasil</option>
            </select>

            <label>Tanggal Keluar</label>
            <input type="date" name="tanggal_keluar">

            <label>Foto Bakteri</label>
            <input type="file" name="foto_bakteri" accept="image/*">

            <div style="margin-top: 20px;">
                <button type="submit">Simpan</button>
                <a href="{{ route('lab.bakteri.kategori', $kategori) }}" class="btn-cancel">Kembali</a>
            </div>
        </form>
    </main>
</body>
</html>