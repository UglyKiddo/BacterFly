<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MProduksi extends Model
{
    protected $table = 'dataproduksi'; // nama tabel di database
    protected $guarded = [];       // semua kolom bisa diisi (read-only saja)
    public $timestamps = false;    // jika tabel tidak punya created_at, updated_at
}
