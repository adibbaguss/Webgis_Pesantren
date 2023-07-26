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
                'nspp' => $faker->numberBetween(10000000000, 99999999999),
                'name' => 'Pondok Pesantren  Al Anwar',
                'category' => $faker->randomElement($category),
                'phone_number' => $faker->phoneNumber(12),
                'website' => 'www.' . $faker->word(7) . '.com',
                'email' => $faker->email,
                'standing_date' => $faker->date,
                'pimpinan' => 'Bisri Mustofa, K',
                'surface_area' => $faker->randomNumber(4, true),
                'building_area' => $faker->randomNumber(4, true),
                'city' => 'Batang',
                'subdistrict' => 'Wonotunggal',
                'postal_code' => $faker->randomNumber(6, true),
                'address' => $faker->address,
                'latitude' => -7.045128617879581,
                'longitude' => 109.75696233803795,
                'status' => 'active',
            ],

            [
                'user_id' => 3,
                'nspp' => $faker->numberBetween(10000000000, 99999999999),
                'name' => 'Pondok Pesantren  Manbaul Athfal',
                'category' => $faker->randomElement($category),
                'phone_number' => $faker->phoneNumber(12),
                'website' => 'www.' . $faker->word(7) . '.com',
                'email' => $faker->email,
                'standing_date' => $faker->date,
                'pimpinan' => 'Hijroh Saputro, Ky',
                'surface_area' => $faker->randomNumber(4, true),
                'building_area' => $faker->randomNumber(4, true),
                'city' => 'Batang',
                'subdistrict' => 'Kandeman',
                'postal_code' => $faker->randomNumber(6, true),
                'address' => $faker->address,
                'latitude' => -6.957249693403769,
                'longitude' => 109.76413294602055,
                'status' => 'active',
            ],

            [
                'user_id' => 4,
                'nspp' => $faker->numberBetween(10000000000, 99999999999),
                'name' => 'Pondok Pesantren Al Istiqomah',
                'category' => $faker->randomElement($category),
                'phone_number' => $faker->phoneNumber(12),
                'website' => 'www.' . $faker->word(7) . '.com',
                'email' => $faker->email,
                'standing_date' => $faker->date,
                'pimpinan' => 'Achmad Zaenuri, KH',
                'surface_area' => $faker->randomNumber(4, true),
                'building_area' => $faker->randomNumber(4, true),
                'city' => 'Batang',
                'subdistrict' => 'Banyuputih',
                'postal_code' => $faker->randomNumber(6, true),
                'address' => $faker->address,
                'latitude' => -6.984362696532386,
                'longitude' => 109.93297200254665,
                'status' => 'active',
            ],
        ];

        foreach ($ponpes as $key => $value) {
            Ponpes::create($value);
        }

    }
}
