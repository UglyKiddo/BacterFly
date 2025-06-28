@extends('layouts.app') {{-- Menggunakan layout bawaan --}}

@section('content')
<style>
    body {
        margin: 0;
        font-family: 'Courier New', monospace;
        background-color: #000;
        color: white;
    }

    .top-bar {
        padding: 10px;
        background-color: #000;
        border-bottom: 1px solid #333;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .logo {
        display: flex;
        align-items: center;
        justify-content: center;
        color: #FF8C42;
        font-size: 14px;
    }

    .logo img {
        height: 30px;
        margin-right: 10px;
    }

    .nav-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px;
        width: 80%;
        max-width: 300px;
    }

    .nav-bar a,
    .nav-bar span {
        color: white;
        font-size: 16px;
        text-decoration: none;
    }

    .nav-bar .title {
        font-weight: bold;
    }

    .profile-container {
        text-align: center;
        margin-top: 40px;
    }

    .avatar img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background-color: #666;
    }

    .username {
        font-family: Georgia, serif;
        margin-top: 10px;
        font-size: 24px;
    }

    .user-info {
        text-align: center;
        width: 100%;
        margin-top: 10px;
        font-size: 18px;
    }

    .bottom-nav {
        display: flex;
        justify-content: space-around;
        background: #000;
        padding: 10px 0;
        position: fixed;
        bottom: 0;
        width: 100%;
        box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.5);
        border-top: 1px solid #555;
    }

    .bottom-nav a {
        color: #fff;
        text-decoration: none;
        display: flex;
        flex-direction: column;
        align-items: center;
        font-size: 12px;
        transition: transform 0.2s, opacity 0.2s;
    }

    .bottom-nav img {
        width: 24px;
        height: 24px;
        margin-bottom: 2px;
        opacity: 0.7;
    }

    .bottom-nav a:hover img,
    .bottom-nav a.active img {
        opacity: 1;
        transform: scale(1.2);
    }

    .bottom-nav a.active {
        color: #FF8C42;
    }

    .bottom-nav a:hover {
        color: #FF8C42;
    }

    @media (max-width: 600px) {
        .bottom-nav img {
            width: 20px;
            height: 20px;
        }

        .bottom-nav a {
            font-size: 10px;
        }

        .nav-bar {
            width: 90%;
            max-width: 250px;
        }
    }
</style>

<header class="top-bar">
    <div class="logo"> 
        <img src="{{ asset('logo.png') }}" alt="Logo BacterFly">
        <span>Welcome To <strong>BacterFly</strong></span>
    </div>
    <div class="nav-bar">
        <a href="javascript:history.back()" class="back">&lt; Kembali</a>
        <span class="title">Profil</span>
        <a href="{{ url('lab/edit-profil') }}" class="edit">Ubah</a>
    </div>
</header>

<main class="profile-container">
    <div class="avatar">
        <img src="{{ $foto_path }}" alt="Foto Profil" />
    </div>
    <h2 class="username">{{ $nama }}</h2>

    <div class="user-info">
        <p>Email: {{ $email }}</p>
        <p>Divisi: {{ $division }}</p>
    </div>
</main>

<div class="bottom-nav">
    <a href="{{ route('lab.dashboard') }}">
        <span>🏠</span>
        <span>Home</span>
    </a>
    <a href="{{ route('lab.bakteri.index') }}">
        <span>🕒</span>
        <span>Data</span>
    </a>
    <a href="{{ route('lab.intruksi') }}">
        <span>📋</span>
        <span>Instruksi</span>
    </a>
    <a href="{{ route('lab.profil') }}" class="active">
        <span>👤</span>
        <span>Profil</span>
    </a>
</div>
@endsection