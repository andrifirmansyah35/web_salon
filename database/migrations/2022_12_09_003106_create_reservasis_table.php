<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_operasi_id');
            $table->foreignId('user_id');
            $table->foreignId('layanan_id');
            $table->foreignId('operasi_id');
            $table->enum('status', ['antri', 'diproses', 'selesai', 'dibatalkan', 'tidak datang', 'batal hapus']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservasi');
    }
}