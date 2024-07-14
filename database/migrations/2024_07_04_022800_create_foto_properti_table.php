<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotoPropertiTable extends Migration
{
    public function up()
    {
        Schema::create('foto_properti', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('properti_id');
            $table->string('path');
            $table->timestamps();

            $table->foreign('properti_id')->references('id')->on('properti')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('foto_properti');
    }
}
