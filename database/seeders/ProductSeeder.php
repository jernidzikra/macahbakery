<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            // ===== BOLEN =====
            [
                'id_produk' => 'PRD001',
                'nama_produk' => 'Pisang Bolen - Keju Special',
                'kategori' => 'Bolen',
                'harga_produk' => 72500,
                'stok_produk' => 100,
                'terjual' => 150,
                'desk_produk' => 'Bolen pisang dengan isian keju special.',
                'foto_produk' => 'images/products/brownies.jpg'
            ],
            [
                'id_produk' => 'PRD002',
                'nama_produk' => 'Pisang Bolen - Cokelat Keju',
                'kategori' => 'Bolen',
                'harga_produk' => 75000,
                'stok_produk' => 80,
                'terjual' => 120,
                'desk_produk' => 'Bolen pisang dengan isian cokelat dan keju.',
                'foto_produk' => 'images/products/donat.png'
            ],
            [
                'id_produk' => 'PRD003',
                'nama_produk' => 'Durian Keju Bolen',
                'kategori' => 'Bolen',
                'harga_produk' => 72500,
                'stok_produk' => 60,
                'terjual' => 90,
                'desk_produk' => 'Bolen dengan isian durian dan keju.',
                'foto_produk' => 'images/products/kastangel.jpg'
            ],
            [
                'id_produk' => 'PRD004',
                'nama_produk' => 'Peyeum Keju Bolen',
                'kategori' => 'Bolen',
                'harga_produk' => 70000,
                'stok_produk' => 75,
                'terjual' => 85,
                'desk_produk' => 'Bolen dengan isian tape singkong dan keju.',
                'foto_produk' => 'images/products/kue tart.jpg'
            ],
            
            // ===== BROWNIES =====
            [
                'id_produk' => 'PRD005',
                'nama_produk' => 'Brownies Coklat Premium',
                'kategori' => 'Brownies',
                'harga_produk' => 115000,
                'stok_produk' => 50,
                'terjual' => 200,
                'desk_produk' => 'Brownies panggang dengan coklat premium.',
                'foto_produk' => 'images/products/nastar.jpg'
            ],
            
            // ===== CEMILAN =====
            [
                'id_produk' => 'PRD006',
                'nama_produk' => 'Cheese Stick Original',
                'kategori' => 'Cemilan KS',
                'harga_produk' => 71500,
                'stok_produk' => 75,
                'terjual' => 110,
                'desk_produk' => 'Stik keju gurih dengan taburan keju cheddar.',
                'foto_produk' => 'images/products/putri salju.jpg'
            ],
            
            // ===== KUKIS =====
            [
                'id_produk' => 'PRD007',
                'nama_produk' => 'Kukis Coklat Chip',
                'kategori' => 'Kukis',
                'harga_produk' => 65000,
                'stok_produk' => 90,
                'terjual' => 70,
                'desk_produk' => 'Kukis dengan coklat chip premium.',
                'foto_produk' => 'images/products/semprit.jpg'
            ],
            
            // ===== KUE =====
            [
                'id_produk' => 'PRD008',
                'nama_produk' => 'Roti Manis',
                'kategori' => 'Roti',
                'harga_produk' => 45000,
                'stok_produk' => 120,
                'terjual' => 50,
                'desk_produk' => 'Roti manis yang lembut dan empuk.',
                'foto_produk' => 'images/products/roti manis.jpg'
            ],
            [
                'id_produk' => 'PRD009',
                'nama_produk' => 'Chocochip Cookies',
                'kategori' => 'Kukis',
                'harga_produk' => 65000,
                'stok_produk' => 100,
                'terjual' => 60,
                'desk_produk' => 'Kukis coklat chip yang renyah.',
                'foto_produk' => 'images/products/chocochip cookies.jpg'
            ],
            [
                'id_produk' => 'PRD010',
                'nama_produk' => 'Pandan Keju',
                'kategori' => 'Kue',
                'harga_produk' => 85000,
                'stok_produk' => 80,
                'terjual' => 40,
                'desk_produk' => 'Kue pandan dengan topping keju.',
                'foto_produk' => 'images/products/pandan keju.jpg'
            ],
            [
                'id_produk' => 'PRD011',
                'nama_produk' => 'Cake Tape Keju',
                'kategori' => 'Kue',
                'harga_produk' => 90000,
                'stok_produk' => 75,
                'terjual' => 35,
                'desk_produk' => 'Cake tape keju yang lembut.',
                'foto_produk' => 'images/products/cake tape keju.jpg'
            ],
            [
                'id_produk' => 'PRD012',
                'nama_produk' => 'Lapis Surabaya',
                'kategori' => 'Kue',
                'harga_produk' => 120000,
                'stok_produk' => 50,
                'terjual' => 25,
                'desk_produk' => 'Kue lapis surabaya premium.',
                'foto_produk' => 'images/products/lapis surabaya.jpg'
            ],
            [
                'id_produk' => 'PRD013',
                'nama_produk' => 'Donat Ring',
                'kategori' => 'Cemilan',
                'harga_produk' => 35000,
                'stok_produk' => 150,
                'terjual' => 100,
                'desk_produk' => 'Donat ring dengan topping glaze.',
                'foto_produk' => 'images/products/donat ring.jpg'
            ],
            [
                'id_produk' => 'PRD014',
                'nama_produk' => 'Bolu Gulung Batik',
                'kategori' => 'Kue',
                'harga_produk' => 95000,
                'stok_produk' => 60,
                'terjual' => 30,
                'desk_produk' => 'Bolu gulung motif batik.',
                'foto_produk' => 'images/products/bolu gulung batik.jpg'
            ],
            [
                'id_produk' => 'PRD015',
                'nama_produk' => 'Bolu Gulung Coklat',
                'kategori' => 'Kue',
                'harga_produk' => 85000,
                'stok_produk' => 70,
                'terjual' => 45,
                'desk_produk' => 'Bolu gulung isian coklat.',
                'foto_produk' => 'images/products/bolu gulung coklat.jpg'
            ],
            [
                'id_produk' => 'PRD016',
                'nama_produk' => 'Bolu Gulung Pandan',
                'kategori' => 'Kue',
                'harga_produk' => 85000,
                'stok_produk' => 70,
                'terjual' => 40,
                'desk_produk' => 'Bolu gulung isian pandan.',
                'foto_produk' => 'images/products/bolu gulung pandan.jpg'
            ],
            [
                'id_produk' => 'PRD017',
                'nama_produk' => 'Bolu Gunung Vanila',
                'kategori' => 'Kue',
                'harga_produk' => 75000,
                'stok_produk' => 90,
                'terjual' => 50,
                'desk_produk' => 'Bolu gunung rasa vanila.',
                'foto_produk' => 'images/products/bolu gunung vanila.jpg'
            ],
            [
                'id_produk' => 'PRD018',
                'nama_produk' => 'Bolu Tape Keju',
                'kategori' => 'Kue',
                'harga_produk' => 80000,
                'stok_produk' => 85,
                'terjual' => 35,
                'desk_produk' => 'Bolu tape dengan topping keju.',
                'foto_produk' => 'images/products/bolu tape keju.jpg'
            ],
            [
                'id_produk' => 'PRD019',
                'nama_produk' => 'Roti Kopi Mocca',
                'kategori' => 'Roti',
                'harga_produk' => 45000,
                'stok_produk' => 120,
                'terjual' => 55,
                'desk_produk' => 'Roti dengan rasa kopi mocca.',
                'foto_produk' => 'images/products/roti kopi mocca.jpg'
            ],
            [
                'id_produk' => 'PRD020',
                'nama_produk' => 'Kue Sus',
                'kategori' => 'Kue',
                'harga_produk' => 55000,
                'stok_produk' => 100,
                'terjual' => 60,
                'desk_produk' => 'Kue sus dengan isian vla.',
                'foto_produk' => 'images/products/kue sus.jpg'
            ],
            [
                'id_produk' => 'PRD021',
                'nama_produk' => 'Chifon Cake',
                'kategori' => 'Kue',
                'harga_produk' => 70000,
                'stok_produk' => 90,
                'terjual' => 40,
                'desk_produk' => 'Chifon cake yang lembut.',
                'foto_produk' => 'images/products/chifon cake.jpg'
            ],
            [
                'id_produk' => 'PRD022',
                'nama_produk' => 'Hampers 1',
                'kategori' => 'Hampers',
                'harga_produk' => 250000,
                'stok_produk' => 30,
                'terjual' => 15,
                'desk_produk' => 'Paket hampers spesial.',
                'foto_produk' => 'images/products/hempers.png'
            ],
            [
                'id_produk' => 'PRD023',
                'nama_produk' => 'Hampers 2',
                'kategori' => 'Hampers',
                'harga_produk' => 350000,
                'stok_produk' => 25,
                'terjual' => 10,
                'desk_produk' => 'Paket hampers premium.',
                'foto_produk' => 'images/products/hempers 2 yg bnr.png'
            ],
            [
                'id_produk' => 'PRD024',
                'nama_produk' => 'Hampers 3',
                'kategori' => 'Hampers',
                'harga_produk' => 450000,
                'stok_produk' => 20,
                'terjual' => 8,
                'desk_produk' => 'Paket hampers eksklusif.',
                'foto_produk' => 'images/products/hempers 3.png'
            ],
        ];

        foreach ($products as $product) {
            Produk::create($product);
        }
    }
}