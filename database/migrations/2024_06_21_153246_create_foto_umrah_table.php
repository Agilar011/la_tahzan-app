<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotoUmrahTable extends Migration
{
    public function up()
    {
        Schema::create('foto_umrah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('umrah_id');
            $table->string('path');
            $table->timestamps();

            $table->foreign('umrah_id')->references('id')->on('umrah')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('foto_umrah');
    }
}

