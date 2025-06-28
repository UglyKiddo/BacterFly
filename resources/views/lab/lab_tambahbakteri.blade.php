<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Bakteri - BacterFly</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body { background: #000; color: #FFA347; font-family: 'Segoe UI'; margin: 0; padding: 20px; }
    form { background: #111; padding: 20px; border-radius: 10px; }
    input, select { width: 100%; padding: 10px; margin: 10px 0; background: #222; border: 1px solid #FFA347; color: white; border-radius: 5px; }
    button { background: #FFA347; color: #000; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
    a { color: #FFA347; display: inline-block; margin-top: 15px; }
  </style>
</head>
<body>
  <h2>Tambah Data Bakteri - {{ $kategori }}</h2>
  <button onclick="history.back()" class="back-btn">Kembali</button>

  <form method="POST" action="{{ url('lab/proses-tambah-bakteri') }}" enctype="multipart/form-data">
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

    <label>Status Kualitas</label>
    <select name="status_b" required>
      <option value="proses">proses</option>
      <option value="gagal">gagal</option>
      <option value="berhasil">berhasil</option>
    </select>

    <label>Jumlah Bakteri</label>
    <input type="text" name="jumlah_bakteri">

    <label for="foto_bakteri">Foto Bakteri</label>
    <input type="file" name="foto_bakteri" accept="image/*">

    <label>Tanggal Keluar</label>
    <input type="date" name="tanggal_keluar">

    <button type="submit">Simpan</button>
  </form>

</body>
</html>