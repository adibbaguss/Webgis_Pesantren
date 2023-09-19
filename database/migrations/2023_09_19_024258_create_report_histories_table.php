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
        Schema::create('report_histories', function (Blueprint $table) {
            $table->unsignedInteger('report_id');
            $table->date('date');
            $table->enum('status', ['baru', 'dalam proses', 'selesai', 'ditolak'])->default('baru');
            $table->text('information');
            $table->timestamps();

            $table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_histories');
    }
};
