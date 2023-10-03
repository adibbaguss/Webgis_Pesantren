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
        Schema::create('learning_madin', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('madin_id');
            $table->string('name');
            $table->text('description');
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
        Schema::table('learning_madin', function (Blueprint $table) {
            $table->dropForeign(['madin_id']);
        });
        Schema::dropIfExists('learning_madin');
    }
};
