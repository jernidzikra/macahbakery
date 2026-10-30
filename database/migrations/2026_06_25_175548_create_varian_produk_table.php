<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('varian_produk', function (Blueprint $table) {
            $table->string('id_varian', 20)->primary();
            $table->string('id_produk', 20);
            $table->string('nama_varian', 50);
            $table->decimal('harga_tambahan', 15, 2)->default(0);
            $table->integer('stok_varian')->default(0);
            
            $table->foreign('id_produk')
                  ->references('id_produk')
                  ->on('produk')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('varian_produk');
    }
};