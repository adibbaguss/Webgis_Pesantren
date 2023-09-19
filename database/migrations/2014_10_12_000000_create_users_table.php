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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->string('name');
            $table->string('photo_profil')->nullable();
            $table->string('phone_number')->nullable();
            $table->enum('user_role', ['pelapor', 'admin pesantren', 'admin kemenag'])->default('pelapor');
            $table->string('foto_ktp')->nullable();
            $table->string('selfie_ktp')->nullable();
            $table->enum('status', ['not confirmed', 'active', 'blocked'])->default('not confirmed');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
