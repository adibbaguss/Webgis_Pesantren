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
        Schema::create('learning', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ponpes_id');
            $table->string('name');
            $table->text('description');
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
        Schema::table('learning', function (Blueprint $table) {
            $table->dropForeign(['ponpes_id']);
        });
        Schema::dropIfExists('learning');
    }
};
