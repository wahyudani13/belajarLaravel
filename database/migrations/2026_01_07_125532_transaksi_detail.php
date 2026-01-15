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
        //
        Schema::create('transaksi_detail', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('transaksi_id')->constrained('transaksi_header', 'id')->onDelete('cascade')->onUpdate('cascade');
            $table->string('transaksi_id', 30);
            $table->foreignId('barang_id')->constrained('barang', 'id')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('jumlah');
            $table->decimal('harga', 12, 2);
            $table->timestamps();

            $table->foreign('transaksi_id')->references('kode_transaksi')->on('transaksi_header')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('transaksi_detail');
    }
};
