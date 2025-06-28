<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDOException;

class LabController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $divisi = $user->division ?? '-';

        return view('lab.dashboard', compact('divisi'));
    }

    public function bakteri()
    {
        $user = Auth::user();
        $divisi = $user->division ?? '-';

        return view('lab.bakteri', compact('divisi'));
    }

    public function intruksi()
    {
        $user = Auth::user();
        $divisi = $user->division ?? '-';

        $instructions = DB::table('instructions')
            ->where('division', $divisi)
            ->orderByDesc('id')
            ->get();

        return view('lab.intruksi', compact('divisi', 'instructions'));
    }

    public function profil()
    {
        $user = Auth::user();
        $division = $user->division ?? '-';
        $nama = $user->nama ?? 'Tidak Ditemukan';
        $email = $user->email ?? 'Tidak Ditemukan';

        // Ambil foto profil jika ada
        $foto = DB::table('user_photos')
            ->where('user_id', $user->id)
            ->orderByDesc('uploaded_at')
            ->value('foto');

        $foto_path = $foto ? asset('assets/uploads/' . $foto) : asset('images/profile-icon.png');

        return view('lab.profil', compact('division', 'nama', 'email', 'foto_path'));
    }

    public function showForm(Request $request)
    {
        $valid_kategori = ['Peternakan', 'Pertanian', 'Perikanan'];
        $kategori = $request->query('kategori', 'Peternakan');

        if (!in_array($kategori, $valid_kategori)) {
            return redirect()->back()->with('error', 'Kategori tidak valid.');
        }

        return view('lab.tambahbakteri', compact('kategori'));
    }

    public function store(Request $request)
    {
        $valid_kategori = ['Peternakan', 'Pertanian', 'Perikanan'];
        $valid_media = ['NA', 'TSA', 'MRSA', 'PDA'];
        $valid_status = ['proses', 'gagal', 'berhasil'];

        $request->validate([
            'kategori' => ['required', 'in:' . implode(',', $valid_kategori)],
            'nama_bakteri' => ['required', 'string', 'max:255'],
            'media' => ['required', 'in:' . implode(',', $valid_media)],
            'metode_inokulasi' => ['required', 'string', 'max:255'],
            'tanggal_inokulasi' => ['required', 'date'],
            'jumlah_bakteri' => ['required', 'numeric', 'min:0'],
            'status_b' => ['required', 'in:' . implode(',', $valid_status)],
            'tanggal_keluar' => ['nullable', 'date'],
            'foto_bakteri' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
        ]);

        $foto_bakteri = null;
        $upload_dir = 'assets/foto_bakteriInokulasi';

        if ($request->hasFile('foto_bakteri')) {
            $file = $request->file('foto_bakteri');
            $new_file_name = 'bakteri_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $foto_bakteri = $file->storeAs($upload_dir, $new_file_name, 'public');

            if (!$foto_bakteri) {
                return redirect()->back()->with('error', 'Gagal mengunggah gambar.');
            }
        }

        try {
            DB::table('DataInokulasi')->insert([
                'Laboratorium_id' => Auth::user()->id,
                'Manager_id' => 9, // Ubah ke ID manajer dinamis jika perlu
                'kategori' => $request->kategori,
                'nama_bakteri' => $request->nama_bakteri,
                'media' => $request->media,
                'metode_inokulasi' => $request->metode_inokulasi,
                'tanggal_inokulasi' => $request->tanggal_inokulasi,
                'jumlah_bakteri' => $request->jumlah_bakteri,
                'status_b' => $request->status_b,
                'tanggal_keluar' => $request->tanggal_keluar,
                'foto_bakteri' => $foto_bakteri,
            ]);

            // Redirect berdasarkan kategori
            $kategori = strtolower($request->kategori);
            return redirect()->route("lab.bakteri.{$kategori}");
        } catch (PDOException $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }
}