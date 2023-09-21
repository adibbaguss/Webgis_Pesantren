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
        Schema::create('facility', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ponpes_id');
            $table->integer('asrama_lk')->default(0);
            $table->integer('asrama_pr')->default(0);
            $table->integer('masjid')->default(0);
            $table->integer('aula_kegiatan')->default(0);
            $table->integer('ruang_pembelajaran')->default(0);
            $table->integer('perpustakaan')->default(0);
            $table->integer('kantor_pengajar')->default(0);
            $table->integer('dapur')->default(0);
            $table->integer('kantin')->default(0);
            $table->integer('tempat_olahraga')->default(0);
            $table->integer('kamar_mandi')->default(0);
            $table->integer('ruang_kesehatan')->default(0);
            $table->integer('kamar_pengajar')->default(0);
            $table->integer('lab_komputer')->default(0);
            $table->integer('lapangan_pertanian')->default(0);
            $table->integer('lapangan_pertenakan')->default(0);
            $table->integer('laundry')->default(0);
            $table->timestamps();

            //relasi
            $table->foreign('ponpes_id')->references('id')->on('ponpes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('facility', function (Blueprint $table) {
            $table->dropForeign(['ponpes_id']);
        });
        Schema::dropIfExists('facility');
    }
};
