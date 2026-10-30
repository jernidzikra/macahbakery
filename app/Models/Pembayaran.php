<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    
    protected $fillable = [
        'id_pembayaran', 'id_pesanan', 'tgl_bayar', 'metode_bayar', 
        'jumlah_bayar', 'bukti_bayar', 'status_pembayaran'
    ];
    
    protected $casts = [
        'tgl_bayar' => 'date',
    ];
    
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan', 'id_pesanan');
    }
}