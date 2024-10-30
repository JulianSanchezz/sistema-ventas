<?php

use Tests\TestCase;
use App\Livewire\Client\ClientComponent;
use Livewire\Livewire;
use Illuminate\Validation\ValidationException;

class ClientComponentUnitTest extends TestCase
{
    public function test_clean_method_resets_properties()
    {
        $component = Livewire::test(ClientComponent::class);
        
        // Establecer valores en las propiedades
        $component->set('name', 'Test Client');
        $component->set('identificacion' ,'123456');
        
        // Ejecutar clean y verificar si las propiedades se reinician
        $component->call('clean');

        $this->assertNull($component->get('name'));
        $this->assertNull($component->get('identificacion'));
        $this->assertNull($component->telefono);
        $this->assertNull($component->email);
        $this->assertNull($component->empresa);
        $this->assertNull($component->cuit);
    }

    public function test_validation_rules()
    {
        $component = Livewire::test(ClientComponent::class);

        // Definimos datos válidos
        $component->set('name', 'Nombre válido');
        $component->set('identificacion', '123456789');
        $component->set('email', 'email@example.com');

        // La validación no debería arrojar ninguna excepción
        try {
            $component->call('store'); // Llamamos al método 'store' que tiene la validación
            $this->assertTrue(true);
        } catch (ValidationException $e) {
            $this->fail("La validación de datos válidos falló");
        }

        // Probar con datos inválidos
        $component->set('email' , 'email-invalido');

        $component->call('store') // Llamamos al método store que ejecuta la validación
        ->assertHasErrors(['email']); // Aseguramos que el error esté en el campo 'email'
    }
}