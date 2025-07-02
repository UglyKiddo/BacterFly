@php
    $currentRoute = Route::currentRouteName();
@endphp

<div class="bottom-nav">
    <a href="{{ route('lab.dashboard') }}" class="{{ $currentRoute === 'lab.dashboard' ? 'active' : '' }}">
        <span>🏠</span> Home
    </a>
    <a href="{{ route('lab.bakteri.index') }}" class="{{ $currentRoute === 'lab.bakteri.index' || str_contains($currentRoute, 'probakteri.index.') ? 'active' : '' }}">
        <span>🕒</span> Data
    </a>
    <a href="{{ route('lab.instruksi.index') }}" class="{{ str_contains($currentRoute, 'lab.instruksi') ? 'active' : '' }}">
        <span>📋</span> Instruksi
    </a>
    <a href="{{ route('lab.profil') }}" class="{{ str_contains($currentRoute, 'profil') ? 'active' : '' }}">
        <span>👤</span> Profil
    </a>
</div>
