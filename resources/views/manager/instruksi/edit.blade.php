<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Instruksi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/manager.css') }}">
</head>
<body>
<div class="container">
    @include('manager.partials.top-bar')

    <main class="profile-container">
        <h2>Edit Instruksi</h2>

        <form action="{{ route('manager.instruksi.update', $instruksi->id) }}" method="POST">
            @csrf

            <label for="division">Divisi:</label>
            <select id="division" name="division" required>
                <option value="">Pilih Divisi</option>
                <option value="Produksi" {{ $instruksi->division === 'Produksi' ? 'selected' : '' }}>Produksi</option>
                <option value="Laboratorium" {{ $instruksi->division === 'Laboratorium' ? 'selected' : '' }}>Laboratorium</option>
            </select>

            <label for="title">Judul:</label>
            <input type="text" id="title" name="title" value="{{ old('title', $instruksi->title) }}" required>

            <label for="content">Isi Instruksi:</label>
            <textarea id="content" name="content" rows="5" required>{{ old('content', $instruksi->content) }}</textarea>

            <button type="submit">Simpan Perubahan</button>
            <a href="{{ route('manager.instruksi') }}" class="btn-cancel">Batal</a>
        </form>
    </main>

    @include('manager.partials.navbar')
</div>
</body>
</html>
