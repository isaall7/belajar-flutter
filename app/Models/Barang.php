<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'nama_barang',
        'merek',
        'foto',
        'stok',
        'harga',
    ];

    public function barang_masuk()
    {
        return $this->hasMany(Barang_masuk::class, 'barang_id');
    }

    public function ruangan_barang()
    {
        return $this->hasMany(Ruangan_barang::class, 'barang_id');
    }
}
