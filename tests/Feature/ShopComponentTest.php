<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Shop;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Livewire\Shop\ShopComponent;

class ShopComponentTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_updates_shop_details()
    {
        $shop = Shop::factory()->create([
            'name' => 'Nombre original',
            'slogan' => 'Eslogan original',
            'telefono' => '123456789',
            'email' => 'original@example.com',
            'direccion' => 'Calle 123',
            'ciudad' => 'Ciudad original',
        ]);

        Livewire::test(ShopComponent::class)
            ->call('edit')  // Llamar al método 'edit' para inicializar el componente con el modelo
            ->set('name', 'Nombre actualizado')
            ->set('slogan', 'Nuevo eslogan')
            ->set('telefono', '987654321')
            ->set('email', 'nuevo@example.com')
            ->set('direccion', 'Nueva dirección')
            ->set('ciudad', 'Nueva ciudad')
            ->call('update')
            ->assertDispatched('msg', 'Datos actualizados');

        $this->assertDatabaseHas('shops', [
            'id' => $shop->id,
            'name' => 'Nombre actualizado',
            'slogan' => 'Nuevo eslogan',
            'telefono' => '987654321',
            'email' => 'nuevo@example.com',
            'direccion' => 'Nueva dirección',
            'ciudad' => 'Nueva ciudad',
        ]);
    }

    public function test_it_resets_shop_details()
    {
        $shop = Shop::factory()->create([
            'name' => 'Shop Test',
            'slogan' => 'Slogan Test'
        ]);

        Livewire::test(ShopComponent::class)
            ->call('edit') // Inicializamos los datos en el componente
            ->call('clean') // Llamamos al método 'clean' que reinicia las propiedades
            ->assertSet('name', null)
            ->assertSet('slogan', null)
            ->assertSet('telefono', null)
            ->assertSet('email', null)
            ->assertSet('direccion', null)
            ->assertSet('ciudad', null);
    }
}