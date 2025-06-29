<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Instruksi - BacterFly</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/manager.css') }}">
</head>
<body>
<div class="container">

    @include('manager.partials.top-bar')

    <h2 class="page-title">Instruksi</h2>

    {{-- Pesan sukses atau error --}}
    @if (session('success'))
        <div class="message success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="message error">{{ session('error') }}</div>
    @endif

    {{-- Daftar Instruksi --}}
    <div class="instructions-list">
        @forelse ($instructions as $row)
            <div class="instruction-item">
                <p>
                    {{ $row->title }} ({{ $row->division }})
                    <span class="instruction-status {{ $row->status === 'done' ? 'done' : '' }}">
                        [Status: {{ $row->status }}]
                    </span>
                </p>
                <div class="actions">
                    <a href="{{ route('manager.instruksi.detail', $row->id) }}" class="detail">Lihat Detail</a>
                    <a href="{{ route('manager.instruksi.edit', $row->id) }}" class="edit">Edit</a>
                    @if ($row->status !== 'done')
                        <a href="{{ route('manager.instruksi.done', $row->id) }}"
                           class="done"
                           onclick="return confirm('Tandai instruksi ini sebagai selesai?')">
                            Tandai Selesai
                        </a>
                    @endif
                    <a href="{{ route('manager.instruksi.delete', $row->id) }}"
                       class="delete"
                       onclick="return confirm('Yakin ingin menghapus instruksi ini?')">
                        Hapus
                    </a>
                </div>
            </div>
        @empty
            <div class="reminder">
                Pesan !! Tidak ada instruksi yang diberikan!!
            </div>
        @endforelse
    </div>

    {{-- Form Tambah Instruksi --}}
    <div class="add-instruction" id="addForm">
        <form action="{{ route('manager.instruksi.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="division">Divisi:</label>
                <select id="division" name="division" required>
                    <option value="">Pilih Divisi</option>
                    <option value="Produksi">Produksi</option>
                    <option value="Laboratorium">Laboratorium</option>
                </select>
            </div>
            <div class="form-group">
                <label for="title">Judul Instruksi:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="content">Isi Instruksi:</label>
                <textarea id="content" name="content" rows="4" required></textarea>
            </div>
            <button type="submit" class="submit">Submit</button>
        </form>
    </div>

    {{-- Tombol Tambah Instruksi --}}
    <div class="add-button">
        <a href="#" onclick="event.preventDefault(); toggleForm();">+</a>
    </div>

    @include('manager.partials.navbar')

</div>

<script>
    function toggleForm() {
        const form = document.getElementById('addForm');
        const button = document.querySelector('.add-button');
        if (form.style.display === 'none' || form.style.display === '') {
            form.style.display = 'block';
            button.style.display = 'none';
        }
    }
</script>
</body>
</html>
