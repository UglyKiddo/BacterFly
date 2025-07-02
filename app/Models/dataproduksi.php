<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class dataproduksi extends Model
{
    protected $table = 'dataproduksi'; // pakai nama tabel lama
    protected $primaryKey = 'p_id'; // pakai primary key lama
    public $timestamps = true;

    protected $fillable = [
        'Manager_id',
        'Produksi_id',
        'kategori',
        'nama_bakteri',
        'media',
        'metode_produksi',
        'tanggal_masuk',
        'jumlah_masuk',
        'jumlah_keluar',
        'status_perkembangan',
        'tanggal_keluar',
        'foto_bakteri',
    ];
}
