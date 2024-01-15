<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

// Sesuaikan dengan model autentikasi yang Anda gunakan

class AuthTest extends TestCase
{
    use RefreshDatabase; // Gunakan ini untuk mereset basis data setiap kali test dijalankan

    public function testUserCanLogin()
    {
        $user = User::factory()->create(); // Membuat pengguna untuk diuji

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password', // Sesuaikan dengan kata sandi pengguna yang dibuat oleh factory
        ]);

        $response->assertStatus(302); // Harapannya, login akan mengarahkan ke status 302 (pengalihan)
        $this->assertAuthenticated(); // Harapannya, pengguna harus terautentikasi setelah login
    }

    public function testUserCanLogout()
    {
        $user = User::factory()->create(); // Membuat pengguna untuk diuji

        $this->actingAs($user); // Mengautentikasi pengguna untuk test

        $response = $this->post('/logout');

        $response->assertStatus(302); // Harapannya, logout akan mengarahkan ke status 302 (pengalihan)
        $this->assertGuest(); // Harapannya, pengguna harus menjadi tamu setelah logout
    }
}
