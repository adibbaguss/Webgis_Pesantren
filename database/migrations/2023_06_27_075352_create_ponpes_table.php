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
            $table->unsignedInteger('user_id')->nullable()->unique();; // Foreign key to users table
            $table->unsignedBigInteger('nspp')->unique();
            $table->string('name');
            $table->string('category');
            $table->enum('takhasus', ['yes', 'no'])->default('no');
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
            $table->string('address')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->enum('status', ['active', 'non-active'])->default('active');
            $table->timestamps();

            //relasi
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
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
