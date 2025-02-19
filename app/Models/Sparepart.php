<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_mesin',
        'tipe_mesin',
        'nama_sparepart',
        'jumlah_stok',
        'sparepart_keluar',
        'sparepart_masuk',
        'sisa_stok',
        'harga_per_pcs'
    ];
}