<?php
namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class ProController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        return view('produksi.dashboard', [
            'nama' => $user->nama,
            'divisi' => $user->division,
        ]);
    }
}
