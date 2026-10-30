<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VarianProduk extends Model
{
    protected $table = 'varian_produk';
    protected $primaryKey = 'id_varian';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    
    protected $fillable = [
        'id_varian', 'id_produk', 'nama_varian', 'harga_tambahan', 'stok_varian'
    ];
    
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
}