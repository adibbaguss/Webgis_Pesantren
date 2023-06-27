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
        Schema::create('student_count', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ponpes_id');
            $table->integer('year');
            $table->integer('male_resident_count');
            $table->integer('female_resident_count');
            $table->integer('male_non_resident_count');
            $table->integer('female_non_resident_count');
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
        Schema::table('student_count', function (Blueprint $table) {
            $table->dropForeign(['ponpes_id']);
        });
        Schema::dropIfExists('student_count');
    }
};
