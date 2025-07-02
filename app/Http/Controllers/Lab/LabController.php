<?php
namespace App\Http\Controllers\Lab;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class LabController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        return view('lab.dashboard', [
            'nama' => $user->nama,
            'divisi' => $user->division,
        ]);
    }
}
