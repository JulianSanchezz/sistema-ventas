<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use App\Livewire\User\UserComponent;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserComponentTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_a_user()
    {
        Livewire::test(UserComponent::class)
            ->set('name', 'New User')
            ->set('email', 'newuser@example.com')
            ->set('password', 'password123')
            ->set('re_password', 'password123')
            ->call('store')
            ->assertDispatched('msg', 'Usuario creado correctamente.');

        $this->assertDatabaseHas('users', [
            'name' => 'New User',
            'email' => 'newuser@example.com'
        ]);
    }

    public function test_it_can_update_a_user()
    {
        $user = User::factory()->create();

        Livewire::test(UserComponent::class)
            ->call('edit', $user->id)
            ->set('name', 'Updated Name')
            ->call('update', $user)
            ->assertDispatched('msg', 'Usuario editado correctamente.');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name'
        ]);
    }

    public function test_it_can_delete_a_user()
    {
        $user = User::factory()->create();

        Livewire::test(UserComponent::class)
            ->call('destroy', $user->id)
            ->assertDispatched('msg', 'Usuario eliminado correctamente.');

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    
}