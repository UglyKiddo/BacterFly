<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Bakteri - {{ $kategori }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/pro.css') }}">
</head>
<body class="tambah-bakteri-page">
    <div class="top-bar">
        <div class="logo">
            <img src="{{ asset('logo.png') }}" alt="Logo">
            <span>Tambah Data - Produksi <strong>BacterFly</strong></span>
        </div>
    </div>
    <main class="edit-form">
        <form method="POST" action="{{ route('produksi.probakteri.store', ['kategori' => $kategori]) }}" enctype="multipart/form-data" class="edit-form">
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

            <label>Metode Produksi</label>
            <input type="text" name="metode_produksi" required>

            <label>Tanggal Produksi</label>
            <input type="date" name="tanggal_masuk" required>

            <label>Jumlah Bakteri (stok)</label>
            <input type="number" name="jumlah_masuk">

            <label>Jumlah Bakteri yang akan digunakan</label>
            <input type="number" name="jumlah_keluar">

            <label>Status Kualitas</label>
            <select name="status_perkembangan" required>
                <option value="kurang">kurang</option>
                <option value="lebih">lebih</option>
            </select>

            <label>Tanggal Keluar</label>
            <input type="date" name="tanggal_keluar">

            <label>Foto Bakteri</label>
            <input type="file" name="foto_bakteri" accept="image/*">

            <div style="margin-top: 20px;">
                <button type="submit">Simpan</button>
                <a href="{{ route('produksi.probakteri.kategori', $kategori) }}" class="btn-cancel">Kembali</a>
            </div>
        </form>
    </main>

</body>
</html>
