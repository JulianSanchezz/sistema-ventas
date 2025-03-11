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
    public function test_it_can_create_a_new_category()
    {
        // Simula el componente Livewire
        Livewire::test(CategoryComponent::class)
            ->set('name', 'Nueva Categoria') // Configura el nombre de la categoría
            ->call('store') // Llama al método 'store'
            ->assertDispatched('msg', 'Categoría creada correctamente');  // Verifica si se dispara el evento con el mensaje
    
        // Verifica que la categoría se haya creado en la base de datos
        $this->assertDatabaseHas('categories', [
            'name' => 'Nueva Categoria',
            'categoriaEstado' => true, 
        ]);
    }
    
    /** @test */
    public function it_can_delete_a_category()
    {
        // Creamos una categoría de ejemplo
        $category = Category::factory()->create(['name' => 'Categoria para eliminar']);

        Livewire::test(CategoryComponent::class)
            ->call('destroy', $category->id)
            ->assertDispatched('msg', 'Categoría desactivada correctamente.', 'success');

        // Verificar que la categoría fue desactivada (baja lógica)
        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'categoriaEstado' => false,
        ]);
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
