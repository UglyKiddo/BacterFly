<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dataproduksi;

class ProBakteriController extends Controller
{
    public function index()
    {
        return view('produksi.probakteri.index');
    }

    public function kategori($kategori)
    {
        $user = Auth::user();

        $validKategori = ['Peternakan', 'Perikanan', 'Pertanian'];
        if (!in_array($kategori, $validKategori)) {
            abort(404, 'Kategori tidak valid.');
        }

        $data = Dataproduksi::where('kategori', $kategori)->orderByDesc('p_id')->get();

        return view('produksi.probakteri.kategori', compact('data', 'kategori', 'user'));
    }

    public function create($kategori)
    {
        return view('produksi.probakteri.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|in:Peternakan,Perikanan,Pertanian',
            'nama_bakteri' => 'required|string',
            'media' => 'required|string|in:NA,TSA,MRSA,PDA',
            'metode_produksi' => 'required|string',
            'tanggal_masuk' => 'required|date',
            'jumlah_masuk' => 'nullable|integer',
            'jumlah_keluar' => 'nullable|integer',
            'status_perkembangan' => 'required|in:kurang,lebih',
            'tanggal_keluar' => 'nullable|date',
            'foto_bakteri' => 'nullable|image|max:2048',
        ]);

        $fileName = null;
        if ($request->hasFile('foto_bakteri')) {
            $file = $request->file('foto_bakteri');
            $fileName = 'bakteri_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('foto_bakteriProduksi'), $fileName);
        }

        Dataproduksi::create([
            'Manager_id' => $request->user()->manager_id ?? 9,
            'Produksi_id' => $request->user()->id,
            'kategori' => $request->kategori,
            'nama_bakteri' => $request->nama_bakteri,
            'media' => $request->media,
            'metode_produksi' => $request->metode_produksi,
            'tanggal_masuk' => $request->tanggal_masuk,
            'jumlah_masuk' => $request->jumlah_masuk,
            'jumlah_keluar' => $request->jumlah_keluar,
            'status_perkembangan' => $request->status_perkembangan,
            'tanggal_keluar' => $request->tanggal_keluar,
            'foto_bakteri' => $fileName
        ]);

        return redirect()->route('produksi.probakteri.kategori', $request->kategori)->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $bakteri = Dataproduksi::findOrFail($id);
        return view('produksi.probakteri.edit', compact('bakteri'));
    }

    public function update(Request $request, $id)
    {
        $data = Dataproduksi::findOrFail($id);

        $request->validate([
            'nama_bakteri' => 'required|string',
            'media' => 'required|in:NA,TSA,MRSA,PDA',
            'metode_produksi' => 'required|string',
            'tanggal_masuk' => 'required|date',
            'jumlah_masuk' => 'nullable|integer',
            'jumlah_keluar' => 'nullable|integer',
            'status_perkembangan' => 'required|in:kurang,lebih',
            'tanggal_keluar' => 'nullable|date',
            'foto_bakteri' => 'nullable|image|max:2048'
        ]);

        $fileName = $data->foto_bakteri;

        if ($request->hasFile('foto_bakteri')) {
            // Hapus file lama jika ada
            if ($fileName && file_exists(public_path('foto_bakteriProduksi/' . $fileName))) {
                unlink(public_path('foto_bakteriProduksi/' . $fileName));
            }

            $file = $request->file('foto_bakteri');
            $fileName = 'bakteri_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('foto_bakteriProduksi'), $fileName);
        }

        $data->update([
            'nama_bakteri' => $request->nama_bakteri,
            'media' => $request->media,
            'metode_produksi' => $request->metode_produksi,
            'tanggal_masuk' => $request->tanggal_masuk,
            'jumlah_masuk' => $request->jumlah_masuk,
            'jumlah_keluar' => $request->jumlah_keluar,
            'status_perkembangan' => $request->status_perkembangan,
            'tanggal_keluar' => $request->tanggal_keluar,
            'foto_bakteri' => $fileName
        ]);

        return redirect()->route('produksi.probakteri.kategori', $data->kategori)->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = Dataproduksi::findOrFail($id);

        if ($data->foto_bakteri && file_exists(public_path('foto_bakteriProduksi/' . $data->foto_bakteri))) {
            unlink(public_path('foto_bakteriProduksi/' . $data->foto_bakteri));
        }

        $kategori = $data->kategori;
        $data->delete();

        return redirect()->route('produksi.probakteri.kategori', $kategori)->with('success', 'Data berhasil dihapus.');
    }
}
