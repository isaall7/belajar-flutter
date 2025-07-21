<?php

namespace App\Models;

use App\Models\Barang;
use App\Models\Ruangan;
use Illuminate\Database\Eloquent\Model;

class Ruangan_barang extends Model
{
    protected $fillable = [
        'barang_id',
        'ruangan_id',
        'stok',
        'tgl_masuk',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'ruangan_barang_id');
    }
    public function detail_pengembalian()
    {
        return $this->hasMany(DetailPengembalian::class);
    }
}
