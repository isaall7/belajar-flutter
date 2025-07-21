<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $fillable = [
        'peminjaman_id',
        'tgl_pengembalian',
        'status',
        'catatan',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    public function detail_peminjaman()
    {
        return $this->belongsTo(DetailPinjaman::class);
    }

    public function detail_pengembalian()
    {
        return $this->hasMany(DetailPengembalian::class);
    }


}
