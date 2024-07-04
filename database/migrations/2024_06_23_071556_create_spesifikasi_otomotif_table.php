<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpesifikasiOtomotifTable extends Migration
{
    public function up()
    {
        Schema::create('spesifikasi_otomotif', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('otomotif_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('transmisi', ['manual', 'matic']);
            $table->enum('stnk', ['ya', 'tidak']);
            $table->enum('bpkb', ['ya', 'tidak']);
            $table->string('type');
            $table->string('subtype');
            $table->string('seller');
            $table->string('address');
            $table->string('phone');
            $table->string('kilometer');
            $table->string('kapasitas_mesin');
            $table->date('tahun_pembuatan');
            $table->string('brand');
            $table->timestamps();

            $table->foreign('otomotif_id')->references('id')->on('otomotif')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Pastikan tabel ini benar
        });
    }

    public function down()
    {
        Schema::dropIfExists('spesifikasi_otomotif');
    }
}
