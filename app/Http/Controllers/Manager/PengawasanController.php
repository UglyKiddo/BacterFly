<?php
namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;

class PengawasanController extends Controller
{
    public function index()
    {
        return view('manager.pengawasan.index');
    }
}
