<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use App\Models\Category;
use App\Livewire\Product\ProductComponent;


class ProductShowTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_products_correctly()
    {
        // Creamos una categoría y un producto
        $category = Category::factory()->create([
            'name' => 'Categoria de prueba'
        ]);
        $product = Product::factory()->create([
            'name' => 'Producto de prueba',
            'category_id' => $category->id,
            'precio_venta' => 20.50,
            'stock' => 50, 
        ]);

        // Simulamos el componente Livewire
        Livewire::test(ProductComponent::class)
            ->assertSee($product->name)  // Verifica que se vea el nombre del producto
            ->assertSee($category->name)  // Verifica que se vea la categoría asociada
            ->assertSee($product->precio_venta)  // Verifica que se vea el precio
            ->assertSee($product->stock); // Verifica que se vea el stock

    }
}