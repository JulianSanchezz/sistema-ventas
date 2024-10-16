<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CategoryShowTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_the_category_details()
    {
        // Creamos una categoría para la prueba
        $category = Category::factory()->create([
            'name' => 'Categoría de prueba',
        ]);

        // Probamos el componente Livewire
        Livewire::test('category.category-show', ['category' => $category])
            ->assertSee($category->name); // Verifica que se vea el nombre de la categoría
    }
}
