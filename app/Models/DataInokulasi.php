<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataInokulasi extends Model
{
    protected $table = 'DataInokulasi';

    protected $fillable = [
        'Laboratorium_id',
        'Manager_id',
        'kategori',
        'nama_bakteri',
        'media',
        'metode_inokulasi',
        'tanggal_inokulasi',
        'jumlah_bakteri',
        'status_b',
        'tanggal_keluar',
        'foto_bakteri',
    ];
}
