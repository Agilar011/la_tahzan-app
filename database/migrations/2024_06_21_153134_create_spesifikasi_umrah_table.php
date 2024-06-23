<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpesifikasiUmrahTable extends Migration
{
    public function up()
    {
        Schema::create('spesifikasi_umrah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('umrah_id');
            $table->string('agen_travel');
            $table->string('nomor_telefon_agen');
            $table->string('maskapai');
            $table->string('hotel');
            $table->date('tanggal_keberangkatan');
            $table->integer('durasi');
            $table->timestamps();

            $table->foreign('umrah_id')->references('id')->on('umrah')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('spesifikasi_umrah');
    }
}

