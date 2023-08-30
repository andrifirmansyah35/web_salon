<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        date_default_timezone_set('Asia/Jakarta');
        Schema::create('layanan', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('kategori_layanan_id');
            $table->unsignedBigInteger('kategori_layanan_id');
            $table->foreign('kategori_layanan_id')->references('id')->on('kategori_layanan');
            // ---------------------------
            $table->string('slug');
            $table->string('nama');
            $table->bigInteger('harga');
            $table->string('deskripsi')->nullable();
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
        Schema::dropIfExists('layanan');
    }
}
