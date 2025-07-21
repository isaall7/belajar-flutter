<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPengembalian extends Model
{
    protected $fillable = [
        'pengembalian_id', 
        'peminjaman_id',
        'detail_peminjaman_id',
        'jumlah_dikembalikan',
        'keterangan'
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id', 'id');
    }

    public function detail_peminjaman()
    {
        return $this->belongsTo(DetailPinjaman::class);
    }
    public function ruangan_barang()
    {
        return $this->belongsTo(Ruangan_barang::class);
    }
    public function pengembalian()
    {
        return $this->belongsTo(Pengembalian::class);
    }
}
