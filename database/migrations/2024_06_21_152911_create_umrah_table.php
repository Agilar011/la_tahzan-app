<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUmrahTable extends Migration
{
    public function up()
    {
        Schema::create('umrah', function (Blueprint $table) {
            $table->id();
            $table->string('judul_produk');
            $table->text('deskripsi_produk');
            $table->decimal('harga', 10, 0);
            $table->enum('status_ads', ['pending','show']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('umrah');
    }
}

