<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    protected $table = 'detail_pesanan';
    protected $primaryKey = ['id_pesanan', 'id_produk'];
    public $incrementing = false;
    public $timestamps = false;
    
    protected $fillable = [
        'id_pesanan', 'id_produk', 'jumlah', 'harga'
    ];
    
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan', 'id_pesanan');
    }
    
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
}