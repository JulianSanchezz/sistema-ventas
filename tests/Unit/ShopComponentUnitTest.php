<?php

use Tests\TestCase;
use App\Livewire\Shop\ShopComponent;
use Livewire\Livewire;
use Illuminate\Validation\ValidationException;

class ShopComponentUnitTest extends TestCase
{
    // public function test_clean_method_resets_properties()
    // {
    //     $component = Livewire::test(ShopComponent::class);
        
    //     // Establecer valores en las propiedades
    //     $component->set('name', 'Shop Test');
    //     $component->set('slogan', 'Best shop ever');
    //     $component->set('telefono', '123456');
        
    //     // Ejecutar el método `clean` y verificar si las propiedades se reinician
    //     $component->call('clean');

    //     $this->assertNull($component->get('name'));
    //     $this->assertNull($component->get('slogan'));
    //     $this->assertNull($component->get('telefono'));
    //     $this->assertNull($component->email);
    //     $this->assertNull($component->direccion);
    //     $this->assertNull($component->ciudad);
    //     $this->assertNull($component->image);
    //     $this->assertNull($component->imageModel);
    // }

    // public function test_validation_rules()
    // {
    //     $component = Livewire::test(ShopComponent::class);

    //     // Datos válidos para probar la validación
    //     $component->set('name', 'Nombre válido');
    //     $component->set('email', 'email@example.com');
        
    //     try {
    //         $component->call('update'); // Llamar al método `update` que realiza la validación
    //         $this->assertTrue(true); // Si no se lanza ninguna excepción, la validación pasó
    //     } catch (ValidationException $e) {
    //         $this->fail("La validación de datos válidos falló.");
    //     }

    //     // Datos inválidos para verificar que la validación falle
    //     $component->set('name','');
    //     $component->set('email', 'email-invalido');
    //     $component->call('update')->assertHasErrors(['name','email']);
    // }
}