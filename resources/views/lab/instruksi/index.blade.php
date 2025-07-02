<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Instruksi Laboratorium - BacterFly</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/pro.css') }}">
</head>
<body>
<div class="container">
    @include('lab.partials.top-bar')
    <main>

        @if ($instructions->isEmpty())
            <div class="reminder">Pesan !! Tidak ada instruksi produksi yang diberikan!!</div>
        @endif

        <div class="instructions-list">
            @foreach ($instructions as $instruction)
                <div class="instruction-item">
                    <div>
                        <p class="instruction-title">{{ $instruction->title }}</p>
                        <p class="instruction-details">
                            Dibuat pada: {{ \Carbon\Carbon::parse($instruction->created_at)->format('d/m/Y H:i') }}
                        </p>
                        <span class="instruction-status {{ $instruction->status === 'done' ? 'done' : '' }}">
                            [Status: {{ $instruction->status ?? 'pending' }}]
                        </span>
                    </div>
                    <div class="actions">
                        <a href="{{ route('lab.instruksi.detail', $instruction->id) }}" class="detail">Lihat Detail</a>
                        @if ($instruction->status !== 'done')
                            <a href="{{ route('lab.instruksi.done', $instruction->id) }}" class="done">Selesai</a>
                        @else
                            <a href="#" class="done completed">Selesai</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    @include('lab.partials.navbar')
</div>
</body>
</html>
