<?php

namespace Tests\Feature;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_todos_page(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/todos');

        $response->assertStatus(200);
    }

    public function test_unauthenticated_user_cannot_view_todos_page(): void
    {
        $response = $this->get('/todos');

        $response->assertRedirect('/login');
    }

    public function test_user_can_create_a_todo(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/todos', [
            'title' => 'My first todo',
            'description' => 'This is the description',
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        
        $this->assertDatabaseHas('todos', [
            'title' => 'My first todo',
            'description' => 'This is the description',
            'user_id' => $user->id,
            'is_completed' => false,
        ]);
    }

    public function test_user_can_update_a_todo(): void
    {
        $user = User::factory()->create();
        $todo = Todo::create([
            'title' => 'Old Title',
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->put("/todos/{$todo->id}", [
            'title' => 'New Title',
            'description' => 'New Description',
        ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
            'title' => 'New Title',
            'description' => 'New Description',
        ]);
    }

    public function test_user_can_toggle_todo_completion(): void
    {
        $user = User::factory()->create();
        $todo = Todo::create([
            'title' => 'Test completion',
            'user_id' => $user->id,
            'is_completed' => false,
        ]);

        $response = $this->actingAs($user)->put("/todos/{$todo->id}", [
            'is_completed' => true,
        ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
            'is_completed' => 1,
        ]);
    }

    public function test_user_can_delete_a_todo(): void
    {
        $user = User::factory()->create();
        $todo = Todo::create([
            'title' => 'Todo to delete',
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->delete("/todos/{$todo->id}");

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('todos', [
            'id' => $todo->id,
        ]);
    }

    public function test_user_cannot_interact_with_other_users_todos(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $todo = Todo::create([
            'title' => 'User 1 Todo',
            'user_id' => $user1->id,
        ]);

        // User 2 tries to delete User 1's todo
        $response = $this->actingAs($user2)->delete("/todos/{$todo->id}");
        $response->assertStatus(403); // Forbidden

        // User 2 tries to update User 1's todo
        $response = $this->actingAs($user2)->put("/todos/{$todo->id}", [
            'is_completed' => true
        ]);
        $response->assertStatus(403); // Forbidden
    }
}
