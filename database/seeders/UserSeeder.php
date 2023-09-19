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
                'username' => 'updater22',
                'password' => bcrypt('123456'),
                'email' => 'updater2@gmail.com',
                'name' => 'admin pesantren',
                'user_role' => 'admin pesantren',
                'status' => 'active',

            ],

            [
                'username' => 'pelapor',
                'password' => bcrypt('123456'),
                'email' => 'pelapor@gmail.com',
                'name' => 'pelapor',
                'user_role' => 'pelapor',

            ],

            [
                'username' => 'viewe2r',
                'password' => bcrypt('123456'),
                'email' => 'pelapor2@gmail.com',
                'name' => 'pelapor2',
                'user_role' => 'pelapor',
                'status' => 'active',

            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
