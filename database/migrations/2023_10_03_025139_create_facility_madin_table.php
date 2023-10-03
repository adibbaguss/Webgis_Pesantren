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
        Schema::create('facility_madin', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('madin_id');
            $table->integer('mushola')->default(0);
            $table->integer('kelas_pengajaran')->default(0);
            $table->integer('perpustakaan')->default(0);
            $table->integer('ruang_guru')->default(0);
            $table->integer('lapangan')->default(0);
            $table->integer('fasilitas_audio_visual')->default(0);
            $table->integer('kamar_mandi')->default(0);
            $table->integer('ruangan_administrasi')->default(0);
            $table->timestamps();

            //relasi
            $table->foreign('madin_id')->references('id')->on('madin')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('facility_madin', function (Blueprint $table) {
            $table->dropForeign(['madin_id']);
        });
        Schema::dropIfExists('facility_madin');
    }
};
