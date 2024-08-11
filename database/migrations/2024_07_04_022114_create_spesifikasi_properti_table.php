<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpesifikasiPropertiTable extends Migration
{
    public function up()
    {
        Schema::create('spesifikasi_properti', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('properti_id');
            $table->unsignedBigInteger('user_id');
            $table->string('alamat');
            $table->string('kota');
            $table->string('provinsi');
            $table->string('jenis_properti');
            $table->string('luas_tanah');
            $table->string('seller');
            $table->string('status_seller');
            $table->string('address');
            $table->string('phone');
            $table->string('luas_bangunan')->nullable();
            $table->integer('jumlah_kamar_tidur')->nullable();
            $table->integer('jumlah_kamar_mandi')->nullable();
            $table->enum('sertifikat', ['ya','tidak']);
            $table->string('fasilitas');
            $table->timestamps();

            $table->foreign('properti_id')->references('id')->on('properti')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('spesifikasi_properti');
    }
}
