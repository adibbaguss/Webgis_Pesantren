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
                'username' => 'admin',
                'password' => bcrypt('123456'),
                'email' => 'admin123@gmail.com',
                'name' => 'administrator',
                'user_role' => 'admin',

            ],
            [
                'username' => 'updater11',
                'password' => bcrypt('123456'),
                'email' => 'updater1@gmail.com',
                'name' => 'updater',
                'user_role' => 'updater',

            ],
            [
                'username' => 'updater22',
                'password' => bcrypt('123456'),
                'email' => 'updater2@gmail.com',
                'name' => 'updater',
                'user_role' => 'updater',

            ],
            [
                'username' => 'updater33',
                'password' => bcrypt('123456'),
                'email' => 'updater3@gmail.com',
                'name' => 'updater',
                'user_role' => 'updater',

            ],
            [
                'username' => 'viewer',
                'password' => bcrypt('123456'),
                'email' => 'viewer@gmail.com',
                'name' => 'viewer',
                'user_role' => 'viewer',

            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
