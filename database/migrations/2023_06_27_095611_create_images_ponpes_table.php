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
        Schema::create('images_ponpes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ponpes_id');
            $table->string('image_name')->nullable();
            $table->string('type')->nullable();
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
        Schema::table('images_ponpes', function (Blueprint $table) {
            $table->dropForeign(['ponpes_id']);
        });
        Schema::dropIfExists('images_ponpes');
    }
};
