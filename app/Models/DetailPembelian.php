<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    protected $table = 'detail_pembelian';
    public $incrementing = false;
    public $timestamps = false;
    
    protected $fillable = [
        'id_pembelian', 'id_bahan', 'jumlah', 'harga_beli'
    ];
    
    protected $casts = [
        'jumlah' => 'decimal:2',
        'harga_beli' => 'decimal:2',
    ];
    
    // Composite key
    protected function setKeysForSaveQuery($query)
    {
        $query->where('id_pembelian', $this->getAttribute('id_pembelian'))
              ->where('id_bahan', $this->getAttribute('id_bahan'));
        return $query;
    }
    
    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class, 'id_pembelian', 'id_pembelian');
    }
    
    public function bahanBaku()
    {
        return $this->belongsTo(BahanBaku::class, 'id_bahan', 'id_bahan');
    }
}