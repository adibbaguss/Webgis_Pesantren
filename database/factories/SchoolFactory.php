<?php
// database/factories/SchoolFactory.php

namespace Database\Factories;

use App\Models\Ponpes;
use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolFactory extends Factory
{
    protected $model = School::class;

    public function definition()
    {
        // Get a list of available 'ponpes' records that are not already associated with a 'School'.
        $availablePonpes = Ponpes::whereDoesntHave('school')->get();

        // Check if there are available 'ponpes' records.
        if ($availablePonpes->isEmpty()) {
            // If no available 'ponpes' records are found, create a new 'ponpes' record.
            $ponpes = Ponpes::factory()->create();
        } else {
            // Otherwise, randomly select an available 'ponpes' record.
            $ponpes = $availablePonpes->random();
        }

        return [
            'ponpes_id' => $ponpes->id,

            'sd' => "SD" . $this->faker->company,
            'smp' => "SMP " . $this->faker->company,
            'sma' => "SMA " . $this->faker->company,
            'smk' => "SMK " . $this->faker->company,
            'pt' => "PT " . $this->faker->company,

        ];
    }
}
