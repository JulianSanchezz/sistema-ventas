<?php

namespace Tests\Unit;

use App\Livewire\Category\CategoryShow;
use App\Models\Category;
use Livewire\Livewire;
use Tests\TestCase;

class CategoryShowTest extends TestCase
{
    /** @test */
    public function it_can_initialize_with_a_category()
    {
        // Crear una categoría para la prueba
        $category = Category::factory()->create(['name' => 'Categoría de Prueba']);

        // Instanciar el componente y pasar la categoría
        $component = Livewire::test(CategoryShow::class, ['category' => $category]);

        // Verificar que la categoría fue inicializada correctamente
        $this->assertEquals($category->id, $component->category->id);
        $this->assertEquals($category->name, $component->category->name);
    }

}