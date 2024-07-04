<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtomotifTable extends Migration
{
    public function up()
    {
        Schema::create('otomotif', function (Blueprint $table) {
            $table->id();
            $table->string('judul_produk');
            $table->text('deskripsi_produk');
            $table->decimal('harga', 12, 0);
            $table->enum('status_ads', ['pending','show']);
            $table->enum('status_payment', ['unpaid','paid','expired']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('otomotif');
    }
}
