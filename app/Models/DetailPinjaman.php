<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPinjaman extends Model
{
    use HasFactory;
    
    protected $table = 'detail_peminjamen'; 

    protected $fillable = [
        'peminjaman_id', 
        'ruangan_barang_id', 
        'jumlah',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    public function ruangan_barang()
    {
        return $this->belongsTo(Ruangan_barang::class);
    }
    public function pengembalian()
    {
        return $this->hasMany(Pengembalian::class);
    }
    public function detail_pengembalian()
    {
        return $this->hasMany(DetailPengembalian::class);
    }
}