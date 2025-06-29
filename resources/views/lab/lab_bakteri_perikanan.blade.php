<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Inokulasi - BacterFly</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background: #000;
            color: #fff;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .top-bar {
            padding: 10px;
            background-color: #000;
            border-bottom: 1px solid #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }
        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #FF8C42;
            font-size: 14px;
            font-family: 'Courier New', monospace;
        }
        .logo img {
            height: 30px;
            margin-right: 10px;
        }
        .division {
            margin-top: 5px;
            font-size: 14px;
        }
        .report-section {
            flex: 1;
            padding: 80px 16px 70px;
            overflow-y: auto;
        }
        .report-section::-webkit-scrollbar {
            width: 10px;
        }
        .report-section::-webkit-scrollbar-track {
            background: #222;
            border-radius: 5px;
        }
        .report-section::-webkit-scrollbar-thumb {
            background: #FF8C42;
            border-radius: 5px;
        }
        .report-section::-webkit-scrollbar-thumb:hover {
            background: #FFA500;
        }
        .report-section {
            scrollbar-width: thin;
            scrollbar-color: #FF8C42 #222;
        }
        .bacteria-item {
            background-color: #FF8C42;
            color: #000;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .bacteria-item img {
            height: 40px;
        }
        .bacteria-info {
            flex-grow: 1;
        }
        .bacteria-info p {
            margin: 5px 0;
            font-size: 14px;
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
        .logout-btn {
            background-color: #FF4500;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s, transform 0.2s;
            position: absolute;
            top: 16px;
            right: 16px;
        }
        .logout-btn:hover {
            background-color: #FF6347;
            transform: scale(1.05);
        }
        .logout-btn:active {
            background-color: #E03A2E;
            transform: scale(0.98);
        }
        .back-btn {
            background-color: #FFA347;
            color: black;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin-bottom: 20px;
            transition: background-color 0.3s, transform 0.2s;
        }
        .back-btn:hover {
            background-color: #FFB873;
            transform: scale(1.05);
        }
        .back-btn:active {
            background-color: #FF8C42;
            transform: scale(0.98);
        }
        @media (max-width: 600px) {
            .bacteria-item img {
                height: 30px;
            }
            .bacteria-info p {
                font-size: 12px;
            }
            .bottom-nav img {
                width: 20px;
                height: 20px;
            }
            .bottom-nav a {
                font-size: 10px;
            }
            .report-section {
                padding: 70px 16px 60px;
            }
        }
            .bacteria-item {
            transition: opacity 0.5s ease;
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="top-bar">
            <div class="logo">
                <img src="{{ asset('logo.png') }}" alt="BacterFly Logo">
                <span>Welcome To <strong>BacterFly</strong></span>
            </div>
            <div class="division">{{ $divisi }}</div>
            <a href="{{ url('logout') }}">
                <button type="button" class="logout-btn">Logout</button>
            </a>
        </header>

        <div class="report-section">
            <button onclick="location.href='{{ route('lab.bakteri.index') }}'" class="back-btn">Kembali</button>
            <h2>Inokulasi Bidang Perikanan</h2>
            @if ($results->isEmpty())
                <p>Tidak ada data inokulasi.</p>
            @else
                @foreach ($results as $row)
                    <div class="bacteria-item" id="item-{{ $row->inokulasi_id }}">
                        @if (!empty($row->foto_bakteri))
                            <img src="{{ asset('assets/foto_bakteriInokulasi/' . $row->foto_bakteri) }}"
                                 alt="Foto Bakteri"
                                 style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                        @endif
                        <div class="bacteria-info">
                            <p><strong>ID Inokulasi:</strong> {{ $row->inokulasi_id }}</p>
                            <p><strong>Kategori:</strong> {{ $row->kategori }}</p>
                            <p><strong>Nama Bakteri:</strong> {{ $row->nama_bakteri }}</p>
                            <p><strong>Media:</strong> {{ $row->media }}</p>
                            <p><strong>Metode Inokulasi:</strong> {{ $row->metode_inokulasi }}</p>
                            <p><strong>Tanggal Inokulasi:</strong> {{ $row->tanggal_inokulasi }}</p>
                            <p><strong>Jumlah Bakteri:</strong> {{ $row->jumlah_bakteri }}</p>
                            <p><strong>Status Kualitas:</strong> {{ $row->status_b }}</p>
                            <p><strong>Tanggal Keluar:</strong> {{ $row->tanggal_keluar }}</p>
                        </div>
                        <div style="margin-top: 10px;">
                            <a href="{{ url('lab/editbakteri?id=' . $row->inokulasi_id) }}"
                               style="background:#FFA347; color:black; padding:6px 12px; border:none; border-radius:5px; text-decoration:none; border:1px solid black;">
                                ✏️ Edit
                            </a>
                            <button onclick="hapusData({{ $row->inokulasi_id }})"
                                    style="background:#FFA347; color:black; padding:8px 12px; border:none; border-radius:5px; text-decoration:none; border:1px solid black;">
                                🗑️ Hapus
                            </button>
                        </div>
                    </div>
                @endforeach
            @endif

            <div style="text-align: center; margin: 10px;">
                <a href="{{ url('lab/tambah-bakteri?kategori=Perikanan') }}">
                    <button style="background:#FFA347; color:black; padding:10px 20px; border:none; border-radius:5px;">
                        ➕
                    </button>
                </a>
            </div>
        </div>

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
            <a href="{{ route('lab.profil') }}">
                <span>👤</span>
                <span>Profil</span>
            </a>
        </div>
    </div>

    <script>
        function hapusData(id) {
            if (confirm("Yakin ingin menghapus data?")) {
                fetch("{{ url('lab/hapusbakteri') }}?id=" + id, { method: 'GET' })
                    .then(response => {
                        if (!response.ok) throw new Error("Gagal menghapus");
                        return response.text();
                    })
                    .then(data => {
                        const el = document.getElementById("item-" + id);
                        if (el) {
                            el.style.opacity = 0;
                            setTimeout(() => el.remove(), 500);
                        }
                    })
                    .catch(error => alert("Terjadi kesalahan: " + error));
            }
        }
    </script>
</body>
</html>