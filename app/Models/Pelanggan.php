<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    
    protected $fillable = [
        'id_pelanggan', 'nama_pelanggan', 'alamat', 'no_telp', 'tipe_pelanggan'
    ];
    
    public function ulasan()
    {
        return $this->hasMany(Ulasan::class, 'id_pelanggan', 'id_pelanggan');
    }
    
    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'id_pelanggan', 'id_pelanggan');
    }
}