<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'id_supplier';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    
    protected $fillable = [
        'id_supplier', 'nama_supplier', 'alamat', 'no_telp'
    ];
    
    public function pembelian()
    {
        return $this->hasMany(Pembelian::class, 'id_supplier', 'id_supplier');
    }
}