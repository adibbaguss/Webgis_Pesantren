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
        Schema::create('reports_madin', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('madin_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('category_id');
            $table->string('reporting_code')->unique;
            $table->string('title');
            $table->text('description');
            $table->timestamps();

            //relasi
            $table->foreign('madin_id')->references('id')->on('madin')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('category_report_madin')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reports_madin', function (Blueprint $table) {
            $table->dropForeign(['madin_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['category_id']);
        });
        Schema::dropIfExists('reports_madin');
    }
};
