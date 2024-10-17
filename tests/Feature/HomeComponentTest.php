<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Livewire\Livewire;
use App\Livewire\Home\Inicio;

class HomeComponentTest extends TestCase{

    use RefreshDatabase;

    /** @test */
    public function it_can_render_the_inicio_component()
    {
        // Prueba si el componente se renderiza correctamente
        Livewire::test(Inicio::class)
            ->assertStatus(200)  // Verifica que el estado de la respuesta sea 200
            ->assertViewIs('livewire.home.inicio');  // Verifica que se esté usando la vista correcta
    }
}