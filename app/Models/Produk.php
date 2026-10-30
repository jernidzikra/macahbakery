<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    
    protected $fillable = [
        'id_produk', 'nama_produk', 'kategori', 'harga_produk',
        'stok_produk', 'terjual', 'desk_produk', 'foto_produk'
    ];
    
    // ===== RELASI ULASAN =====
    public function ulasan()
    {
        return $this->hasMany(Ulasan::class, 'id_produk', 'id_produk');
    }
    
    // ===== RELASI VARIAN =====
    public function varian()
    {
        return $this->hasMany(VarianProduk::class, 'id_produk', 'id_produk');
    }
    
    // ===== ACCESSOR RATING =====
    public function getRatingAttribute()
    {
        return $this->ulasan()->avg('rating') ?? 0;
    }
    
    public function getJumlahUlasanAttribute()
    {
        return $this->ulasan()->count() ?? 0;
    }
}