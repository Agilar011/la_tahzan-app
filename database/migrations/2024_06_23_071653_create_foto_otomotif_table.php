<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotoOtomotifTable extends Migration
{
    public function up()
    {
        Schema::create('foto_otomotif', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('otomotif_id');
            $table->string('path');
            $table->timestamps();

            $table->foreign('otomotif_id')->references('id')->on('otomotif')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('foto_otomotif');
    }
}

