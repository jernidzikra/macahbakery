<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_admin', 'nama_admin', 'username', 'password', 'no_telp'
    ];

    protected $hidden = [
        'password',
    ];

    // Relasi ke Pesanan
    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'id_admin', 'id_admin');
    }
}
