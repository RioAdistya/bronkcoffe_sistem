<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_produk', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("idProduk")->unsigned();
            $table->bigInteger("idKategori")->unsigned();
            $table->bigInteger("type_id")->default(2);
            $table->smallInteger("jumlahStok");
            $table->bigInteger("hargaPer100Gram");
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
        Schema::dropIfExists('detail_produk');
    }
};
