<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->integer('kode_trx');
            $table->unsignedBigInteger('id_produk');
            $table->unsignedBigInteger('id_member');
            $table->date('tanggal');
            $table->integer('jumlah_terjual');
            $table->timestamps();

            $table->foreign('id_produk')->references('id')->on('produk')->onDelete('cascade');
            $table->foreign('id_member')->references('id')->on('member')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
