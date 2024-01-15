<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::factory()->count(10)->create();

        $user = [
            [
                'username' => 'admin_kemenag',
                'password' => bcrypt('12345678'),
                'email' => 'admin123@gmail.com',
                'name' => 'administrator',
                'user_role' => 'admin kemenag',
                'status' => 'active',

            ],

            [
                'username' => 'admin_pesantren_contoh',
                'password' => bcrypt('12345678'),
                'email' => 'pesantren@gmail.com',
                'name' => 'Admin Pesantren Contoh',
                'user_role' => 'admin pesantren',
                'status' => 'active',

            ],

            [
                'username' => 'admin_madin',
                'password' => bcrypt('12345678'),
                'email' => 'madin@gmail.com',
                'name' => 'Admin Madin',
                'user_role' => 'admin madin',
                'status' => 'active',

            ],

            [
                'username' => 'contoh pelapor',
                'password' => bcrypt('12345678'),
                'email' => 'pelapor@gmail.com',
                'name' => 'pelapor',
                'user_role' => 'pelapor',
                'status' => 'active',

            ],

            [
                'username' => 'pelapor_2',
                'password' => bcrypt('12345678'),
                'email' => 'pelapor2@gmail.com',
                'name' => 'pelapor contoh-2',
                'user_role' => 'pelapor',
                'status' => 'active',

            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
