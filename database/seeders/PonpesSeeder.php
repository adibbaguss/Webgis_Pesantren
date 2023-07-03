<?php

namespace Database\Seeders;

use App\Models\Ponpes;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PonpesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ponpes::factory()->count(10)->create();
        $faker = Faker::create();

        $category = ['Pesantren Salafiyah', 'Pesantren Khalafiyah', 'Pesantren Kombinasi'];

        $ponpes = [
            [
                'user_id' => 2,
                'nspp' => $faker->randomDigit(10),
                'name' => 'Pondok Pesantren  Al Anwar, Batang',
                'category' => $faker->randomElement($category),
                'phone_number' => $faker->phoneNumber,
                'website' => 'www.' . $faker->word(7) . '.com',
                'email' => $faker->email,
                'standing_date' => $faker->date,
                'pimpinan' => 'Bisri Mustofa, K',
                'surface_area' => $faker->randomNumber(4, true),
                'building_area' => $faker->randomNumber(4, true),
                'city' => 'Batang',
                'subdistrict' => 'Wono Tunggal',
                'postal_code' => $faker->randomNumber(6, true),
                'address' => $faker->address,
                'latitude' => $faker->latitude($min = -6.4846, $max = '6.4846'),
                'longitude' => $faker->longitude($min = -110.7083, $max = 110.7083),
                'status' => 'active',
            ],

            [
                'user_id' => 3,
                'nspp' => $faker->randomDigit(10),
                'name' => 'Pondok Pesantren  Manbaul Athfal, Batang',
                'category' => $faker->randomElement($category),
                'phone_number' => $faker->phoneNumber,
                'website' => 'www.' . $faker->word(7) . '.com',
                'email' => $faker->email,
                'standing_date' => $faker->date,
                'pimpinan' => 'Hijroh Saputro, Ky',
                'surface_area' => $faker->randomNumber(4, true),
                'building_area' => $faker->randomNumber(4, true),
                'city' => 'Batang',
                'subdistrict' => 'Wono Tunggal',
                'postal_code' => $faker->randomNumber(6, true),
                'address' => $faker->address,
                'latitude' => $faker->latitude($min = -6.4846, $max = '6.4846'),
                'longitude' => $faker->longitude($min = -110.7083, $max = 110.7083),
                'status' => 'active',
            ],

            [
                'user_id' => 4,
                'nspp' => $faker->randomDigit(10),
                'name' => 'Pondok Pesantren  Al Falah, Batang',
                'category' => $faker->randomElement($category),
                'phone_number' => $faker->phoneNumber,
                'website' => 'www.' . $faker->word(7) . '.com',
                'email' => $faker->email,
                'standing_date' => $faker->date,
                'pimpinan' => 'Abdul Qodir, K',
                'surface_area' => $faker->randomNumber(4, true),
                'building_area' => $faker->randomNumber(4, true),
                'city' => 'Batang',
                'subdistrict' => 'Bandar',
                'postal_code' => $faker->randomNumber(6, true),
                'address' => $faker->address,
                'latitude' => $faker->latitude($min = -6.4846, $max = '6.4846'),
                'longitude' => $faker->longitude($min = -110.7083, $max = 110.7083),
                'status' => 'active',
            ],
        ];

        foreach ($ponpes as $key => $value) {
            Ponpes::create($value);
        }

    }
}
