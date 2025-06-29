<?php
namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\MProduksi;
use Illuminate\Http\Request;

class PengawasanProduksiController extends Controller
{
    public function index()
    {
        return view('manager.pengawasan.produksi.index');
    }

    public function showByKategori($kategori)
    {
        $data = MProduksi::where('kategori', $kategori)->get();

        return view('manager.pengawasan.produksi.kategori', [
            'kategori' => $kategori,
            'data' => $data
        ]);
    }
}
