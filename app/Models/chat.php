<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chat';
    protected $primaryKey = 'id_chat';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    
    protected $fillable = [
        'id_chat', 'id_pelanggan', 'id_admin', 'pesan', 
        'is_from_admin', 'is_read', 'created_at'
    ];
    
    protected $casts = [
        'created_at' => 'datetime',
        'is_from_admin' => 'boolean',
        'is_read' => 'boolean',
    ];
    
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }
    
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }
}