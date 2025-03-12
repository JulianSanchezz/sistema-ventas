<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Client;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Livewire\Client\ClientComponent;

class ClientComponentTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_a_client()
    {
        Livewire::test(ClientComponent::class)
            ->set('name', 'Nombre de prueba')
            ->set('identificacion', '123456789')
            ->set('telefono', '123456789')
            ->set('email', 'email@ejemplo.com')
            ->call('store')
            ->assertDispatched('msg', 'Cliente creado correctamente.');

        $this->assertDatabaseHas('clients', [
            'name' => 'Nombre de prueba',
            'identificacion' => '123456789'
        ]);
    }

    public function test_it_updates_a_client()
    {
        $client = Client::factory()->create([
            'name' => 'Nombre original',
            'identificacion' => '123456789'
        ]);

        Livewire::test(ClientComponent::class)
            ->call('edit', $client->id)
            ->set('name', 'Nombre actualizado')
            ->set('identificacion', '987654321')
            ->call('update', $client)
            ->assertDispatched('msg', 'Cliente editado correctamente.');

        $this->assertDatabaseHas('clients', [
            'id' => $client->id,
            'name' => 'Nombre actualizado',
            'identificacion' => '987654321'
        ]);
    }

    public function test_it_deletes_a_client()
    {
        $client = Client::factory()->create([
            'name' => 'Cliente a eliminar',
            'identificacion' => '123456789'
        ]);
    
        Livewire::test(ClientComponent::class)
            ->call('destroy', $client->id)
            ->assertDispatched('msg', 'Cliente dado de baja correctamente.');
    
        $this->assertDatabaseHas('clients', [
            'id' => $client->id,
            'name' => 'Cliente a eliminar',
            'clientActive' => false, // Verificar que se hizo la baja lógica
        ]);
    }
}