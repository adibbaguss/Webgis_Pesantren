<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory as BaseFactory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class UserFactory extends BaseFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    // public function definition()
    // {
    //     $faker = faker::create();
    //     return [
    //         'username' => $faker->unique()->userName,
    //         'password' => Hash::make('password'),
    //         'email' => $faker->unique()->safeEmail,
    //         'name' => $faker->name,
    //         'photo_profil' => null,
    //         'phone_number' => $faker->phoneNumber,
    //         'user_type' => Arr::random(['viewer', 'updater', 'admin']),
    //         'email_verified_at' => now(),
    //         'remember_token' => Str::random(10),
    //     ];
    // }
}
