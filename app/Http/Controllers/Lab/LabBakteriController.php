<?php

namespace App\Http\Controllers\Lab;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Datainokulasi;

class LabBakteriController extends Controller
{
    public function index()
    {
        return view('lab.bakteri.index');
    }

    public function kategori($kategori)
    {
        $user = Auth::user();

        $validKategori = ['Peternakan', 'Perikanan', 'Pertanian'];
        if (!in_array($kategori, $validKategori)) {
            abort(404, 'Kategori tidak valid.');
        }

        $data = Datainokulasi::where('kategori', $kategori)->orderByDesc('inokulasi_id')->get();

        return view('lab.bakteri.kategori', compact('data', 'kategori', 'user'));
    }

    public function create($kategori)
    {
        return view('lab.bakteri.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|in:Peternakan,Perikanan,Pertanian',
            'nama_bakteri' => 'required|string|max:100',
            'media' => 'required|in:NA,TSA,MRSA,PDA',
            'metode_inokulasi' => 'required|string|max:50',
            'tanggal_inokulasi' => 'required|date',
            'jumlah_bakteri' => 'nullable|integer',
            'status_b' => 'required|in:gagal,proses,berhasil',
            'tanggal_keluar' => 'nullable|date',
            'foto_bakteri' => 'nullable|image|max:2048',
        ]);

        $fileName = null;
        if ($request->hasFile('foto_bakteri')) {
            $file = $request->file('foto_bakteri');
            $fileName = 'bakteri_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('foto_bakteriLab'), $fileName);
        }

        Datainokulasi::create([
            'Manager_id' => $request->user()->manager_id ?? 9,
            'Laboratorium_id' => $request->user()->id,
            'kategori' => $request->kategori,
            'nama_bakteri' => $request->nama_bakteri,
            'media' => $request->media,
            'metode_inokulasi' => $request->metode_inokulasi,
            'tanggal_inokulasi' => $request->tanggal_inokulasi,
            'jumlah_bakteri' => $request->jumlah_bakteri,
            'status_b' => $request->status_b,
            'tanggal_keluar' => $request->tanggal_keluar,
            'foto_bakteri' => $fileName,
        ]);

        return redirect()->route('lab.bakteri.kategori', $request->kategori)->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $bakteri = Datainokulasi::findOrFail($id);
        return view('lab.bakteri.edit', compact('bakteri'));
    }

    public function update(Request $request, $id)
    {
        $data = Datainokulasi::findOrFail($id);

        $request->validate([
            'nama_bakteri' => 'required|string|max:100',
            'media' => 'required|in:NA,TSA,MRSA,PDA',
            'metode_inokulasi' => 'required|string|max:50',
            'tanggal_inokulasi' => 'required|date',
            'jumlah_bakteri' => 'nullable|integer',
            'status_b' => 'required|in:gagal,proses,berhasil',
            'tanggal_keluar' => 'nullable|date',
            'foto_bakteri' => 'nullable|image|max:2048',
        ]);

        $fileName = $data->foto_bakteri;

        if ($request->hasFile('foto_bakteri')) {
            if ($fileName && file_exists(public_path('foto_bakteriLab/' . $fileName))) {
                unlink(public_path('foto_bakteriLab/' . $fileName));
            }

            $file = $request->file('foto_bakteri');
            $fileName = 'bakteri_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('foto_bakteriLab'), $fileName);
        }

        $data->update([
            'nama_bakteri' => $request->nama_bakteri,
            'media' => $request->media,
            'metode_inokulasi' => $request->metode_inokulasi,
            'tanggal_inokulasi' => $request->tanggal_inokulasi,
            'jumlah_bakteri' => $request->jumlah_bakteri,
            'status_b' => $request->status_b,
            'tanggal_keluar' => $request->tanggal_keluar,
            'foto_bakteri' => $fileName,
        ]);

        return redirect()->route('lab.bakteri.kategori', $data->kategori)->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = Datainokulasi::findOrFail($id);

        if ($data->foto_bakteri && file_exists(public_path('foto_bakteriLab/' . $data->foto_bakteri))) {
            unlink(public_path('foto_bakteriLab/' . $data->foto_bakteri));
        }

        $kategori = $data->kategori;
        $data->delete();

        return redirect()->route('lab.bakteri.kategori', $kategori)->with('success', 'Data berhasil dihapus.');
    }
}
