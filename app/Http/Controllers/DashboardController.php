<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function lab()
    {
        $user = Auth::user();
        $divisi = $user->division ?? '-';

        return view('lab.dashboard', [
            'nama' => $user->nama ?? 'Tidak Ditemukan',
            'divisi' => $divisi,
        ]);
    }

    public function produksi()
    {
        $user = Auth::user();
        $divisi = $user->division ?? '-';

        return view('produksi.dashboard', [
            'nama' => $user->nama ?? 'Tidak Ditemukan',
            'divisi' => $divisi,
        ]);
    }

    public function manager()
    {
        $user = Auth::user();
        $divisi = $user->division ?? '-';

        return view('manager.dashboard', [
            'nama' => $user->nama ?? 'Tidak Ditemukan',
            'divisi' => $divisi,
        ]);
    }
}
