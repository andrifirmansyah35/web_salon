<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operasi', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('jadwal_operasi_id');
            $table->unsignedBigInteger('jadwal_operasi_id');
            $table->foreign('jadwal_operasi_id')->references('id')->on('jadwal_operasi');
            $table->string('waktu_mulai');
            $table->string('waktu_selesai');
            $table->boolean('status')->default(true);  //karena bisa dipesan bisa juga tidak dipesan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operasis');
    }
}