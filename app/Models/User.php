<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_pelanggan',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relasi ke data pelanggan (biodata & alamat) milik akun ini.
     */
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    /**
     * Ambil data Pelanggan milik user ini, buat baru kalau belum ada.
     * Memastikan satu akun user selalu terhubung ke satu id_pelanggan yang sama,
     * sehingga riwayat pesanan pelanggan konsisten setiap kali checkout.
     */
    public function getOrCreatePelanggan(array $attributes = []): Pelanggan
    {
        if ($this->id_pelanggan && $pelanggan = Pelanggan::find($this->id_pelanggan)) {
            // Perbarui alamat/no telp terbaru kalau dikirim
            if (!empty($attributes)) {
                $pelanggan->fill($attributes);
                $pelanggan->save();
            }
            return $pelanggan;
        }

        $newId = 'PEL' . str_pad((Pelanggan::max('id_pelanggan') ? (int) substr(Pelanggan::max('id_pelanggan'), 3) + 1 : Pelanggan::count() + 1), 3, '0', STR_PAD_LEFT);

        $pelanggan = Pelanggan::create(array_merge([
            'id_pelanggan' => $newId,
            'nama_pelanggan' => $this->name,
            'alamat' => null,
            'no_telp' => null,
            'tipe_pelanggan' => 'regular',
        ], $attributes));

        $this->id_pelanggan = $pelanggan->id_pelanggan;
        $this->save();

        return $pelanggan;
    }
}
