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
        Schema::create('detail_bahan_baku', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idBahan')->unsigned();
            $table->integer('kuantitas');
            $table->bigInteger('hargaSatuan');
            $table->bigInteger("type_id")->default(2);
            $table->timestamps();
            $table->text('keterangan')->nullable()->default('-');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_bahan_baku');
    }
};
