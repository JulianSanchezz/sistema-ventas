<?php

namespace Tests\Unit;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\Category;
use App\Livewire\Category\CategoryComponent;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryComponentTest extends TestCase
{
    use RefreshDatabase; // para limpiar la base de datos entre pruebas

    /** @test */
    public function it_stores_a_category()
    {
        // Simulamos el componente de Livewire
        Livewire::test(CategoryComponent::class)
            ->set('name', 'Nueva Categoria') // Asignamos el nombre de la categoría
            ->call('store') //llamamos al metodo store
            ->assertDispatched('msg', 'Categoria creada correctamente'); // Aseguramos que el mensaje fue enviado

        // Verificamos que la categoría fue creada en la base de datos
        $this->assertDatabaseHas('categories', ['name' => 'Nueva Categoria']);
    }

    /** @test */
    public function it_deletes_a_category()
    {
        // Creamos una categoría de ejemplo
        $category = Category::factory()->create(['name' => 'Categoria para eliminar']);

        Livewire::test(CategoryComponent::class)
            ->call('destroy', $category->id) 
            ->assertDispatched('msg', 'Categoria eliminada correctamente'); 

        //verificamos en la base
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    /** @test */
    public function it_updates_a_category()
    {
        $category = Category::factory()->create(['name' => 'Categoria Original']);

        Livewire::test(CategoryComponent::class)
            ->set('Id', $category->id) // Asignamos el ID de la categoría a editar
            ->set('name', 'Categoria Actualizada') // Actualizamos el nombre
            ->call('update', $category) 
            ->assertDispatched('msg', 'Categoria editada correctamente'); 

        $this->assertDatabaseHas('categories', ['id' => $category->id, 'name' => 'Categoria Actualizada']);
    }
}