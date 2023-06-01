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
            $table->foreignId('jadwal_operasi_id');
            $table->string('waktu_mulai');
            $table->string('waktu_selesai');
            $table->string('status');  //karena bisa dipesan bisa juga tidak dipesan
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