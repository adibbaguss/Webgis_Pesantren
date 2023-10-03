<?php

namespace Database\Seeders;

use App\Models\Madin;
use Faker\Factory;
use Illuminate\Database\Seeder;

class MadinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Factory::create();

        $madin = [
            // contoh
            [
                'user_id' => 2,
                'nsdt' => '310000000001',
                'name' => $faker->word(10),
                'phone_number' => $faker->phoneNumber(12),
                'website' => 'www.' . $faker->word(7) . '.com',
                'email' => $faker->email,
                'standing_date' => $faker->date,
                'pimpinan' => 'Belum diisi',
                'surface_area' => $faker->randomNumber(4, true),
                'building_area' => $faker->randomNumber(4, true),
                'city' => 'Batang',
                'subdistrict' => 'Limpung',
                'postal_code' => 51271,
                'address' => 'Belum diisi',
                'latitude' => -6.993116719850695,
                'longitude' => 109.92871970193553,
                'status' => 'active',
            ],

            // Entry 1 (Daarul Ishlah)
            [
                'nsdt' => '310000000002',
                'name' => $faker->word(10),
                'phone_number' => $faker->phoneNumber(12),
                'website' => 'www.' . $faker->word(7) . '.com',
                'email' => $faker->email,
                'standing_date' => $faker->date,
                'pimpinan' => 'Belum diisi',
                'surface_area' => $faker->randomNumber(4, true),
                'building_area' => $faker->randomNumber(4, true),
                'city' => 'Batang',
                'subdistrict' => 'Bandar',
                'postal_code' => 51254,
                'address' => 'Jl. Puncak Km.4 RT.003/003',
                'latitude' => -7.090687277305945,
                'longitude' => 109.78335146620175,
                'status' => 'active',
            ],

            // Entry 2 (Nurul Hidayah)
            [
                'nsdt' => '310000000003',
                'name' => $faker->word(10),
                'phone_number' => $faker->phoneNumber(12),
                'website' => 'www.' . $faker->word(7) . '.com',
                'email' => $faker->email,
                'standing_date' => $faker->date,
                'pimpinan' => 'Belum diisi',
                'surface_area' => $faker->randomNumber(4, true),
                'building_area' => $faker->randomNumber(4, true),
                'city' => 'Batang',
                'subdistrict' => 'Bandar',
                'postal_code' => 51254,
                'address' => 'Desa Sidayu',
                'latitude' => -7.043354948457385,
                'longitude' => 109.81081745435844,
                'status' => 'active',
            ],
        ];

        foreach ($madin as $key => $value) {
            Madin::create($value);
        }
    }

}
