<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjamen';

    protected $fillable = [
        'nama_peminjam',
        'tgl_meminjam',
        'tgl_pengembalian',
        'ruangan_barang_id',
        'status',
    ];

   public function ruangan_barang() 
   {
      return $this->belongsTo(Ruangan_barang::class, 'ruangan_barang_id');
   }

   public function detail_peminjaman()
    {
        return $this->hasMany(DetailPinjaman::class);
    }

    public function detail_pengembalian()
    {
        return $this->hasMany(DetailPengembalian::class);
    }
    
}
