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
        Schema::create('detail_pengembalians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengembalian_id')->constrained('pengembalians')->onDelete('cascade');
            $table->foreignId('detail_peminjaman_id')->constrained('detail_peminjamen')->onDelete('cascade');
            $table->integer('jumlah_dikembalikan');
            $table->enum('keterangan', ['normal', 'rusak', 'hilang', 'rusak dan hilang'])->default('normal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pengembalians');
    }
};
