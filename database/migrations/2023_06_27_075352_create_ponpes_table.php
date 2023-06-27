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
        Schema::create('ponpes', function (Blueprint $table) {
            $table->increments('id'); // Primary key, auto-incrementing
            $table->unsignedInteger('user_id')->nullable(); // Foreign key to users table
            $table->integer('nspp')->unique(); // Unique NSPP (National School Principal Number)
            $table->string('name');
            $table->string('category');
            $table->string('phone_number')->unique(); // Unique phone number
            $table->string('website')->nullable();
            $table->string('email')->unique(); // Unique email address
            $table->date('standing_date');
            $table->string('photo_profil')->nullable();
            $table->string('pimpinan');
            $table->integer('surface_area');
            $table->integer('building_area');
            $table->string('city');
            $table->string('subdistrict');
            $table->integer('postal_code');
            $table->string('address');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->enum('status',['active', 'non-active'])->default('active');
            $table->timestamps();


            //relasi
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ponpes', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
        Schema::dropIfExists('ponpes');
    }
};
