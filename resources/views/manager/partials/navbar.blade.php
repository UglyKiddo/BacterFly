@php
    $currentRoute = Route::currentRouteName();
@endphp

<div class="bottom-nav">
    <a href="{{ route('manager.dashboard') }}" class="{{ $currentRoute === 'manager.dashboard' ? 'active' : '' }}">
        <span>🏠</span> Home
    </a>
    <a href="{{ route('manager.pengawasan') }}" class="{{ $currentRoute === 'manager.pengawasan' || str_contains($currentRoute, 'pengawasan.') ? 'active' : '' }}">
        <span>🕒</span> Data
    </a>
    <a href="{{ route('manager.instruksi') }}" class="{{ str_contains($currentRoute, 'instruksi') ? 'active' : '' }}">
        <span>📋</span> Instruksi
    </a>
    <a href="{{ route('manager.profil') }}" class="{{ str_contains($currentRoute, 'profil') ? 'active' : '' }}">
        <span>👤</span> Profil
    </a>
</div>
