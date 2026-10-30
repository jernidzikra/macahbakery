<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = 'pembelian';
    protected $primaryKey = 'id_pembelian';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    
    protected $fillable = [
        'id_pembelian', 'id_supplier', 'tgl_pembelian'
    ];
    
    protected $casts = [
        'tgl_pembelian' => 'date',
    ];
    
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier', 'id_supplier');
    }
    
    public function detailPembelian()
    {
        return $this->hasMany(DetailPembelian::class, 'id_pembelian', 'id_pembelian');
    }
}