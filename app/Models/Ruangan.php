<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $fillable = [
        'nama_ruangan',
        'deskripsi',
        'foto',
    ];

    public function barang_masuk()
    {
        return $this->hasMany(Barang_masuk::class, 'ruangan_id');
    }

    public function ruangan_barang()
    {
        return $this->hasMany(Ruangan_barang::class, 'ruangan_id');
    }
}
