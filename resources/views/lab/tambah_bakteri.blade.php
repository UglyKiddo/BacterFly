<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Inokulasi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6 text-center">Tambah Data Inokulasi</h1>
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('inokulasi.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md max-w-lg mx-auto">
            @csrf
            <div class="mb-4">
                <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                <select name="kategori" id="kategori" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Pilih Kategori</option>
                    <option value="Peternakan">Peternakan</option>
                    <option value="Pertanian">Pertanian</option>
                    <option value="Perikanan">Perikanan</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="nama_bakteri" class="block text-sm font-medium text-gray-700">Nama Bakteri</label>
                <input type="text" name="nama_bakteri" id="nama_bakteri" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>
            <div class="mb-4">
                <label for="media" class="block text-sm font-medium text-gray-700">Media</label>
                <select name="media" id="media" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Pilih Media</option>
                    <option value="NA">NA</option>
                    <option value="TSA">TSA</option>
                    <option value="MRSA">MRSA</option>
                    <option value="PDA">PDA</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="metode_inokulasi" class="block text-sm font-medium text-gray-700">Metode Inokulasi</label>
                <input type="text" name="metode_inokulasi" id="metode_inokulasi" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>
            <div class="mb-4">
                <label for="tanggal_inokulasi" class="block text-sm font-medium text-gray-700">Tanggal Inokulasi</label>
                <input type="date" name="tanggal_inokulasi" id="tanggal_inokulasi" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>
            <div class="mb-4">
                <label for="jumlah_bakteri" class="block text-sm font-medium text-gray-700">Jumlah Bakteri</label>
                <input type="number" name="jumlah_bakteri" id="jumlah_bakteri" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>
            <div class="mb-4">
                <label for="status_b" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status_b" id="status_b" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Pilih Status</option>
                    <option value="proses">Proses</option>
                    <option value="berhasil">Berhasil</option>
                    <option value="gagal">Gagal</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="tanggal_keluar" class="block text-sm font-medium text-gray-700">Tanggal Keluar</label>
                <input type="date" name="tanggal_keluar" id="tanggal_keluar" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div class="mb-4">
                <label for="foto_bakteri" class="block text-sm font-medium text-gray-700">Foto Bakteri</label>
                <input type="file" name="foto_bakteri" id="foto_bakteri" accept="image/*" class="mt-1 block w-full">
            </div>
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">Simpan</button>
        </form>
    </div>
</body>
</html>