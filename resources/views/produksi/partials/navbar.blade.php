@php
    $currentRoute = Route::currentRouteName();
@endphp

<div class="bottom-nav">
    <a href="{{ route('produksi.dashboard') }}" class="{{ $currentRoute === 'produksi.dashboard' ? 'active' : '' }}">
        <span>🏠</span> Home
    </a>
    <a href="{{ route('produksi.probakteri.index') }}" class="{{ $currentRoute === 'produksi.probakteri.index' || str_contains($currentRoute, 'probakteri.index.') ? 'active' : '' }}">
        <span>🕒</span> Data
    </a>
    <a href="{{ route('produksi.proinstruksi.index') }}" class="{{ str_contains($currentRoute, 'produksi.proinstruksi') ? 'active' : '' }}">
        <span>📋</span> Instruksi
    </a>
    <a href="{{ route('produksi.proprofil') }}" class="{{ str_contains($currentRoute, 'proprofil') ? 'active' : '' }}">
        <span>👤</span> Profil
    </a>
</div>
