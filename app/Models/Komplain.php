<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komplain extends Model
{
    protected $table = 'komplain';
    protected $primaryKey = 'id_komplain';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    
    protected $fillable = [
        'id_komplain', 'id_pesanan', 'tgl_komplain', 'jenis_komplain', 
        'desk_komplain', 'status_komplain'
    ];
    
    protected $casts = [
        'tgl_komplain' => 'date',
    ];
    
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan', 'id_pesanan');
    }
}