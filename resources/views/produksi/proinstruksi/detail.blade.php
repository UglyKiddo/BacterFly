<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Instruksi - BacterFly</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/pro.css') }}">
</head>
<body>
<div class="container">
    @include('produksi.partials.top-bar')

    <main class="detail-instruction">
        <div class="detail-item">
            <h2 class="instruction-title">{{ $instruction->title }}</h2>
            <p class="instruction-content">{!! nl2br(e($instruction->content)) !!}</p>
            <p class="instruction-details">Divisi: {{ $instruction->division }}</p>
            <span class="instruction-status {{ $instruction->status === 'done' ? 'done' : '' }}">
                [Status: {{ ucfirst($instruction->status) }}]
            </span>

            <div class="actions">
                @if ($instruction->status !== 'done')
                    <a href="{{ route('produksi.proinstruksi.done', $instruction->id) }}" class="mark-done-btn">Selesai</a>
                @else
                    <span class="mark-done-btn completed">Selesai</span>
                @endif
                <a href="{{ route('produksi.proinstruksi.index') }}" class="back-btn">Kembali</a>
            </div>
        </div>
    </main>

    @include('produksi.partials.navbar')
</div>
</body>
</html>
