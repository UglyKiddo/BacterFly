<?php
namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\MInokulasi;
use Illuminate\Http\Request;

class PengawasanInokulasiController extends Controller
{
    public function index()
    {
        return view('manager.pengawasan.inokulasi.index');
    }

    public function showByKategori($kategori)
    {
        $data = MInokulasi::where('kategori', $kategori)->get();
        return view('manager.pengawasan.inokulasi.kategori', compact('kategori', 'data'));
    }
}
