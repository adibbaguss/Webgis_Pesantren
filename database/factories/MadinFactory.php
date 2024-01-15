<?php

namespace Database\Factories;

use App\Models\Madin;
use Faker\Factory as faker;
use Illuminate\Database\Eloquent\Factories\Factory as BaseFactory;

class MadinFactory extends BaseFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Madin::class;

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
            'nsdt' => $faker->unique()->randomNumber(),
            'name' => "cth. Madarasah Diniyah -" . $faker->randomNumber(),
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
            'latitude' => $faker->latitude(-6.93042, -6.971317),
            'longitude' => $faker->longitude(109.87984, 109.856497),
            'status' => $faker->randomElement(['active', 'non-active']),
            'created_at' => $faker->dateTime(),
            'updated_at' => $faker->dateTime(),
        ];
    }
}
