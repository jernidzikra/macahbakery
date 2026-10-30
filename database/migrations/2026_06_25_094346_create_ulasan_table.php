<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ulasan', function (Blueprint $table) {
            $table->string('id_ulasan', 20)->primary();
            $table->string('id_pesanan', 20);
            $table->string('id_produk', 20);
            $table->string('id_pelanggan', 20);
            $table->integer('rating')->check('rating >= 1 AND rating <= 5');
            $table->text('komentar')->nullable();
            $table->date('tgl_ulasan');
            
            $table->foreign('id_pesanan')->references('id_pesanan')->on('pesanan')->onDelete('cascade');
            $table->foreign('id_produk')->references('id_produk')->on('produk')->onDelete('cascade');
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ulasan');
    }
};