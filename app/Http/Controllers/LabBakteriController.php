<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LabBakteriController extends Controller
{
    public function perikanan()
    {
        if (!Session::get('logged_in') || !Session::get('id')) {
            return redirect('login');
        }

        $id_user = Session::get('id');
        $user = DB::table('users')->where('id', $id_user)->first();
        $divisi = $user->division ?? '-';

        $results = DB::table('datainokulasi')
            ->where('kategori', 'Perikanan')
            ->orderByDesc('inokulasi_id')
            ->get();

        return view('lab.lab_bakteri_perikanan', compact('divisi', 'results'));
    }
    public function pertanian()
    {
        if (!Session::get('logged_in') || !Session::get('id')) {
            return redirect('login');
        }

        $id_user = Session::get('id');
        $user = DB::table('users')->where('id', $id_user)->first();

        $divisi = $user->division ?? '-';

        $results = DB::table('datainokulasi')
                    ->where('kategori', 'Pertanian')
                    ->orderByDesc('inokulasi_id')
                    ->get();

        return view('lab.lab_bakteri_pertanian', [
            'divisi' => $divisi,
            'results' => $results
        ]);
    }
    public function peternakan()
    {
        if (!Session::get('logged_in') || !Session::get('id')) {
            return redirect('login');
        }

        $id_user = Session::get('id');
        $user = DB::table('users')->where('id', $id_user)->first();

        $divisi = $user->division ?? '-';

        $results = DB::table('datainokulasi')
                    ->where('kategori', 'Peternakan')
                    ->orderByDesc('inokulasi_id')
                    ->get();

        return view('lab.lab_bakteri_peternakan', [
            'divisi' => $divisi,
            'results' => $results
        ]);
    }
}