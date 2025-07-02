<?php
namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        $foto = DB::table('user_photos')
            ->where('user_id', $user->id)
            ->orderByDesc('uploaded_at')
            ->first();

        $fotoPath = $foto && $foto->foto
            ? Storage::url('uploads/' . $foto->foto)
            : asset('images/profile-icon.png');

        return view('produksi.proprofil.show', compact('user', 'fotoPath'));
    }

    public function edit()
    {
        $user = Auth::user();

        $foto = DB::table('user_photos')
            ->where('user_id', $user->id)
            ->orderByDesc('uploaded_at')
            ->first();

        $fotoPath = $foto && $foto->foto
            ? Storage::url('uploads/' . $foto->foto)
            : asset('images/profile-icon.png');

        return view('produksi.proprofil.edit', compact('user', 'fotoPath'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'division' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Update nama & divisi
        DB::table('users')->where('id', $user->id)->update([
            'nama' => $request->nama,
            'division' => $request->division,
        ]);

        if ($request->hasFile('foto')) {
            // Ambil foto lama (jika ada)
            $oldPhoto = DB::table('user_photos')
                ->where('user_id', $user->id)
                ->orderByDesc('uploaded_at')
                ->first();

            // Hapus file lama dari storage
            if ($oldPhoto && $oldPhoto->foto && Storage::disk('public')->exists('uploads/' . $oldPhoto->foto)) {
                Storage::disk('public')->delete('uploads/' . $oldPhoto->foto);
            }

            // Hapus record lama di DB
            if ($oldPhoto) {
                DB::table('user_photos')->where('id', $oldPhoto->id)->delete();
            }

            // Simpan file baru
            $file = $request->file('foto');
            $filename = uniqid('foto_', true) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads', $filename, 'public');

            // Simpan ke DB
            DB::table('user_photos')->insert([
                'user_id' => $user->id,
                'foto' => $filename,
                'uploaded_at' => now(),
            ]);
        }

        return redirect()->route('produksi.proprofil')->with('success', 'Profil berhasil diperbarui.');
    }
}
