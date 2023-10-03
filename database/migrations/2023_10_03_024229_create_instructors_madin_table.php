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
        Schema::create('instructors_madin', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('madin_id');
            $table->string('nik', 20)->unique();
            $table->string('name', 100);
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->string('expertise');
            $table->enum('status', ['active', 'non-active'])->default('active');
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
        Schema::table('instructors_madin', function (Blueprint $table) {
            $table->dropForeign(['madin_id']);
        });

        Schema::dropIfExists('instructors_madin');
    }
};
