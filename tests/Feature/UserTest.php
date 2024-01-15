<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash; // Make sure to include Hash
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker; // Make sure to include WithFaker

    /**
     * Test creating a user.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $user = User::factory()->create();

        $this->assertDatabaseHas('users', ['id' => $user->id]);
    }

    /**
     * Test updating a user.
     *
     * @return void
     */
    public function testUpdateUser()
    {
        $user = User::factory()->create();

        $user->update(['name' => 'Updated Name']);

        $this->assertEquals('Updated Name', $user->fresh()->name);
    }

    /**
     * Test deleting a user.
     *
     * @return void
     */
    public function testDeleteUser()
    {
        $user = User::factory()->create();

        $user->delete();

        $this->assertDatabaseMissing('users', ['id' => $user->id]); // Use assertDatabaseMissing instead of assertDeleted
    }
}
