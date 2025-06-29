<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInokulasiRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Ubah sesuai kebutuhan otorisasi
    }

    public function rules()
    {
        return [
            'kategori' => 'required|in:Peternakan,Pertanian,Perikanan',
            'nama_bakteri' => 'required|string|max:255',
            'media' => 'required|in:NA,TSA,MRSA,PDA',
            'metode_inokulasi' => 'nullable|string|max:255',
            'tanggal_inokulasi' => 'nullable|date',
            'jumlah_bakteri' => 'nullable|numeric',
            'status_b' => 'required|in:proses,gagal,berhasil',
            'tanggal_keluar' => 'nullable|date',
            'foto_bakteri' => 'nullable|image|max:2048', // max:2048 = 2MB
        ];
    }
}