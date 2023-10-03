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
        Schema::create('images_madin', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('madin_id');
            $table->string('image_name')->nullable();
            $table->string('type')->nullable();
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
        Schema::table('images_madin', function (Blueprint $table) {
            $table->dropForeign(['madin_id']);
        });
        Schema::dropIfExists('images_madin');
    }
};
