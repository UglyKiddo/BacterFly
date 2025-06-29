<?php
namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class ManagerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        return view('manager.dashboard', [
            'nama' => $user->nama,
            'divisi' => $user->division,
        ]);
    }
}
