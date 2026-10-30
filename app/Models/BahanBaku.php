<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    protected $table = 'bahan_baku';
    protected $primaryKey = 'id_bahan';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    
    protected $fillable = [
        'id_bahan', 'nama_bahan', 'stok_bahan', 'satuan'
    ];
    
    protected $casts = [
        'stok_bahan' => 'decimal:2',
    ];
    
    public function detailPembelian()
    {
        return $this->hasMany(DetailPembelian::class, 'id_bahan', 'id_bahan');
    }
}