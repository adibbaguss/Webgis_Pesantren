<?php

namespace Tests\Feature;

use App\Models\Ponpes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PonpesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test creating a Ponpes instance.
     *
     * @return void
     */
    public function testCreatePonpes()
    {
        // Use the factory to create a Ponpes instance
        $ponpes = Ponpes::factory()->create();

        // Assert that the instance was created in the database
        $this->assertDatabaseHas('ponpes', ['id' => $ponpes->id]);

        // Optionally, you can add more assertions for the created instance
    }

    /**
     * Test updating a Ponpes instance.
     *
     * @return void
     */
    public function testUpdatePonpes()
    {
        // Create a Ponpes instance using the factory
        $ponpes = Ponpes::factory()->create();

        // Update the attributes of the Ponpes instance
        $updatedAttributes = [
            'name' => 'Updated Name',
            // Add other attributes to update
        ];

        $ponpes->update($updatedAttributes);

        // Assert that the instance was updated in the database
        $this->assertDatabaseHas('ponpes', $updatedAttributes);
    }

    /**
     * Test deleting a Ponpes instance.
     *
     * @return void
     */
    public function testDeletePonpes()
    {
        // Create a Ponpes instance using the factory
        $ponpes = Ponpes::factory()->create();

        // Delete the Ponpes instance
        $ponpes->delete();

        // Assert that the instance was deleted from the database
        $this->assertDatabaseMissing('ponpes', ['id' => $ponpes->id]);
    }
}
