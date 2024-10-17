<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\Category;
use App\Livewire\Category\CategoryComponent;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryComponentTest extends TestCase{
        
    use RefreshDatabase; // para limpiar la base de datos entre pruebas

    /** @test */
    public function it_can_create_a_new_category()
    {
        // Simular el componente Livewire y llenar el formulario para crear una nueva categoría
        Livewire::test(CategoryComponent::class)
            ->set('name', 'Nueva Categoria')
            ->call('store')
            ->assertDispatched('msg', 'Categoria creada correctamente');  // Verificar mensaje de éxito

        // Verificar que la categoría se creó en la base de datos
        $this->assertDatabaseHas('categories', [
            'name' => 'Nueva Categoria'
        ]);
    }

    /** @test */
    public function it_can_delete_a_category()
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
    public function it_can_update_a_category()
    {
        $category = Category::factory()->create(['name' => 'Categoria Original']);

        Livewire::test(CategoryComponent::class)
            ->set('Id', $category->id) // Asignamos el ID de la categoría a editar
            ->set('name', 'Categoria editada') // Actualizamos el nombre
            ->call('update', $category) 
            ->assertDispatched('msg', 'Categoria editada correctamente'); 

        $this->assertDatabaseHas('categories', ['id' => $category->id, 'name' => 'Categoria editada']);
    }


    /** @test */
    public function it_validates_category_creation_fields()
    {
        Livewire::test(CategoryComponent::class)
            ->set('name', '')  // Nombre vacío para forzar la validación
            ->call('store')
            ->assertHasErrors(['name' => 'required']);  // Verificar que falla por el campo vacío
    }


}
