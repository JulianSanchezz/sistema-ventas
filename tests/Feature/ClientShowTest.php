<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Client;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Livewire\Client\ClientComponent;

class ClientshowTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_shows_client_list()
    {
        Client::factory()->count(10)->create([
            'name' => 'Juan Alberto',
            'identificacion' => '123456789'
        ]);

        Livewire::test(ClientComponent::class)
        ->assertSee('Listado Clientes')
        ->assertSee('Crear Cliente');
    }

}