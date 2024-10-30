<?php

namespace Tests\Feature;

use App\Models\User;
use Livewire\Livewire;
use App\Livewire\User\UserComponent;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_shows_user_list()
    {
        User::factory()->count(10)->create();

        Livewire::test(UserComponent::class)
            ->assertSee('Listado de usuarios')
            ->assertSee('Crear usuario');
    }
}