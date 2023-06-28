<?php

namespace Database\Factories;

use App\Models\Ponpes;
use Faker\Factory as faker;
use Illuminate\Database\Eloquent\Factories\Factory as BaseFactory;

class PonpesFactory extends BaseFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ponpes::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = faker::create();

        return [
            'user_id' => null,
            'nspp' => $faker->unique()->randomNumber(),
            'name' => $faker->company,
            'category' => $faker->randomElement(['Category 1', 'Category 2', 'Category 3']),
            'phone_number' => $faker->unique()->phoneNumber,
            'website' => $faker->optional()->url,
            'email' => $faker->unique()->safeEmail,
            'standing_date' => $faker->date(),
            'photo_profil' => null,
            'pimpinan' => $faker->name,
            'surface_area' => $faker->numberBetween(100, 1000),
            'building_area' => $faker->numberBetween(50, 500),
            'city' => $faker->city,
            'subdistrict' => $faker->streetName,
            'postal_code' => $faker->numerify('######'),
            'address' => $faker->address,
            'latitude' => $faker->latitude,
            'longitude' => $faker->longitude,
            'status' => $faker->randomElement(['active', 'non-active']),
            'created_at' => $faker->dateTime(),
            'updated_at' => $faker->dateTime(),
        ];
    }
}
