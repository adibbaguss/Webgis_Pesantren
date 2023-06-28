<?php

namespace Database\Factories;

use App\Models\Ponpes;
use Faker\Factory as faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ImagePonpes>
 */
class ImagePonpesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = faker::create();
        return [
            'ponpes_id' => function(){
                return Ponpes::factory()->create()->id;
            },
            'image'=>$faker->text(50),
        ];
    }
}
