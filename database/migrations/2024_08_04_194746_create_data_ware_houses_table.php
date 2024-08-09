<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataWareHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_ware_houses', function (Blueprint $table) {
            $table->id();
            $table->string('otomotif_id')->nullable();
            $table->string('properti_id')->nullable();
            $table->string('umrah_id')->nullable();
            $table->string('id_spesifikasi_umrah')->nullable();
            $table->string('id_spesifikasi_otomotif')->nullable();
            $table->string('id_spesifikasi_properti')->nullable();
            $table->string('judul_produk')->nullable();
            $table->string('deskripsi_produk')->nullable();
            $table->string('jenis_produk')->nullable();  // category
            // umrah
            $table->string('agen_travel')->nullable();
            $table->string('maskapai')->nullable();
            $table->string('hotel')->nullable();
            $table->string('durasi')->nullable();
            $table->string('pathUmrah')->nullable();
            // otomotif
            $table->string('subtype')->nullable(); // juga digunakan untuk properti
            $table->integer('cc')->nullable();
            $table->date('tahun_pembuatan')->nullable();
            $table->string('brand')->nullable();
            $table->string('pathOto')->nullable();
            // property
            $table->string('kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->integer('luas_tanah')->nullable();
            $table->integer('luas_bangunan')->nullable();
            $table->integer('kamar_tidur')->nullable();
            $table->integer('kamar_mandi')->nullable();
            $table->string('pathProp')->nullable();
            $table->timestamps(); // Untuk kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_ware_houses');
    }
}
