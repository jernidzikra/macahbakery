<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'id_admin' => 'ADM001',
            'nama_admin' => 'Admin Macah',
            'username' => 'admin',
            'password' => bcrypt('password'),
            'no_telp' => '0812-1122-1984'
        ]);
    }
}