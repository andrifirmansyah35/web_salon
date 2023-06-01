<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalOperasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_operasi', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->unique();
            $table->string('kategori_operasi');
            $table->string('hari',2);
            $table->string('bulan',2);
            $table->string('tahun',4);
            $table->boolean('status');
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
        Schema::dropIfExists('jadwal_operasi');
    }
}