<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasiTable extends Migration
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
            // $table->foreignId('jadwal_operasi_id');
            $table->unsignedBigInteger('jadwal_operasi_id');
            $table->foreign('jadwal_operasi_id')->references('id')->on('jadwal_operasi');
            // $table->foreignId('user_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('user');
            // $table->foreignId('layanan_id');
            $table->unsignedBigInteger('layanan_id');
            $table->foreign('layanan_id')->references('id')->on('layanan');
            // $table->foreignId('operasi_id');
            $table->unsignedBigInteger('operasi_id');
            $table->foreign('operasi_id')->references('id')->on('operasi');
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
