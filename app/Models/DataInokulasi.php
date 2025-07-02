<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class datainokulasi extends Model
{
    protected $table = 'datainokulasi';
    protected $primaryKey = 'inokulasi_id';
    public $timestamps = true; // Nonaktifkan timestamps karena kolomnya tidak ada

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
