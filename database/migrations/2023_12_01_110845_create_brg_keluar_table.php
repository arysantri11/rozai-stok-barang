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
        Schema::create('brg_keluar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id');
            $table->date('tanggal');
            $table->integer('jumlah');
            $table->integer('total_harga');
            $table->string('penerima');
            $table->text('ket')->nullable();
            $table->timestamps();

            $table->foreign('barang_id')->references('id')->on('barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brg_keluar');
    }
};
