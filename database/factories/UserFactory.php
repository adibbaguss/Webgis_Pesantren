<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory as BaseFactory;
use Illuminate\Support\Facades\Hash;

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
    public function definition()
    {
        $faker = \Faker\Factory::create(); // Use \Faker\Factory::create() to create a new instance of the Faker generator
        return [
            'username' => $faker->unique()->userName,
            'password' => Hash::make('password'),
            'email' => $faker->unique()->safeEmail,
            'name' => $faker->name,
            'photo_profil' => null,
            'phone_number' => $faker->phoneNumber,
            'user_role' => $faker->randomElement(['pelapor', 'admin pesantren', 'admin madin', 'admin kemenag']),
            'foto_ktp' => null,
            'selfie_ktp' => null,
            'status' => "active",
        ];
    }
}
