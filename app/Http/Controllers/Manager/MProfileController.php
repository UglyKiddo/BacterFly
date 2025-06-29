<?php
namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        $foto = DB::table('user_photos')
            ->where('user_id', $user->id)
            ->orderByDesc('uploaded_at')
            ->first();

        $fotoPath = $foto
            ? asset('storage/uploads/' . $foto->foto)
            : asset('images/profile-icon.png');

        return view('manager.profil.show', [
            'user' => $user,
            'fotoPath' => $fotoPath
        ]);
    }

    public function edit()
    {
        $user = Auth::user();

        $foto = DB::table('user_photos')
            ->where('user_id', $user->id)
            ->orderByDesc('uploaded_at')
            ->first();

        $fotoPath = $foto
            ? asset('storage/uploads/' . $foto->foto)
            : asset('images/profile-icon.png');

        return view('manager.profil.edit', [
            'user' => $user,
            'fotoPath' => $fotoPath
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'division' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Update nama dan divisi
        DB::table('users')->where('id', $user->id)->update([
            'nama' => $request->nama,
            'division' => $request->division,
        ]);

        // Jika upload foto baru
        if ($request->hasFile('foto')) {
            $oldPhoto = DB::table('user_photos')
                ->where('user_id', $user->id)
                ->orderByDesc('uploaded_at')
                ->first();

            // Hapus foto lama dari storage
            if ($oldPhoto && $oldPhoto->foto && Storage::disk('public')->exists('uploads/' . $oldPhoto->foto)) {
                Storage::disk('public')->delete('uploads/' . $oldPhoto->foto);
            }

            // Hapus entry foto lama dari DB
            if ($oldPhoto) {
                DB::table('user_photos')->where('id', $oldPhoto->id)->delete();
            }

            // Simpan foto baru
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

        return redirect()->route('manager.profil')->with('success', 'Profil berhasil diperbarui.');
    }
}
