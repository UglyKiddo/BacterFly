<?php

namespace App\Http\Controllers;

class IndexController extends Controller
{
    public function index()
    {
        // Menampilkan halaman index
        return view('index'); // resources/views/index.blade.php
    }
}