<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Livewire\Product\ProductComponent;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
use Livewire\Livewire;

class ProductComponentTest extends TestCase
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
            ->assertSee($product->stock); // Verifica que se vea el precio

    }

    /** @test */
    public function it_can_create_a_new_product()
    {
        // Crear una categoría para asociar el nuevo producto
        $category = Category::factory()->create([
            'name' => 'Categoria para producto'
        ]);

        // Simulamos el componente Livewire y llenamos el formulario para crear un nuevo producto
        Livewire::test(ProductComponent::class)
            ->set('name', 'Nuevo Producto')
            ->set('category_id', $category->id)
            ->set('descripcion', 'Descripción del nuevo producto')
            ->set('precio_venta', 100)
            ->set('stock', 50)
            ->call('store')
            ->assertDispatched('msg', 'Producto creada correctamente');  // Verifica el mensaje

        // Verificamos en la base de datos que se haya creado el producto
        $this->assertDatabaseHas('products', [
            'name' => 'Nuevo Producto',
            'precio_venta' => 100
        ]);
    }

    /** @test */
    public function it_validates_product_creation_fields()
    {
        Livewire::test(ProductComponent::class)
            ->set('name', '')  // Nombre vacío para forzar la validación
            ->set('precio_venta', '')  // Precio vacío
            ->call('store')
            ->assertHasErrors(['name' => 'required', 'precio_venta' => 'required']);  // Verifica errores de validación
    }
}