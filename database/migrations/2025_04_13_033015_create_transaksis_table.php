<?php

use App\Models\User;
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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_transaksi');
            $table->string('slug');
            $table->string('whatsapp');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->foreignIdFor(User::class);
            $table->integer('pax');
            $table->date('date');
            $table->text('address')->nullable();
            $table->integer('total');
            $table->enum('status_pembayaran', ['belum bayar', 'sudah dibayar', 'dikembalikan', 'dibatalkan'])->default('belum bayar');
            $table->string('snap_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
