<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Http\Controllers\UserController;

class UserApiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    public function test_users_api_returns_success()
    {
        User::factory()->count(3)->create();

        $response = $this->getJson('/api/users');

        $response->assertStatus(200);

        $response->assertJsonCount(3);
    }
    public function test_it_can_delete_a_user()
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->deleteJson("/api/users/{$user->id}");

        // Assert
        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'User deleted successfully'
                 ]);

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }
     public function test_it_can_update_user()
    {
        // Arrange
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $updatedData = [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
        ];

        // Act
        $response = $this->putJson("/api/users/{$user->id}", $updatedData);

        // Assert
        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'User updated successfully',
                 ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
        ]);
    }
}
