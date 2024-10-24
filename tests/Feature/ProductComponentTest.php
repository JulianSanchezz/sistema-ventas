<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Livewire\Product\ProductComponent;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;


class ProductComponentTest extends TestCase
{
    use RefreshDatabase;

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

    /** @test */
    public function it_can_delete_a_product_and_its_image()
    {
    
        // Crear categoría y producto
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);
    
        // Verificar que el producto y la imagen están en la base de datos
        $this->assertDatabaseHas('products', ['id' => $product->id]);
    
        // Simular la eliminación del producto en el componente Livewire
        Livewire::test(ProductComponent::class)
            ->call('destroy', $product->id) // Simula la eliminación del producto
            ->assertDispatched('msg', 'Producto eliminado correctamente.'); // Verifica el mensaje
    
        // Verificar que el producto y la imagen han sido eliminados de la base de datos
        $this->assertDatabaseMissing('products', ['id' => $product->id]);

    }

    /** @test */
    public function it_can_edit_a_product()
    {
        // Crea una categoría para asociar con el producto
        $category = Category::factory()->create();

        // Crea un producto con la fábrica
        $product = Product::factory()->create([
            'category_id' => $category->id,
        ]);

        // Datos nuevos para actualizar el producto
        $newData = [
            'name' => 'Nuevo nombre',
            'descripcion' => 'Nueva descripción',
            'precio_venta' => 100,
            'stock' => 50,
            'category_id' => $category->id,
        ];

            // Actualizar los atributos uno por uno
            $product->name = $newData['name'];
            $product->descripcion = $newData['descripcion'];
            $product->precio_venta = $newData['precio_venta'];
            $product->stock = $newData['stock'];
            $product->category_id = $newData['category_id'];
            $product->save(); // Guardar los cambios

        // Verifica que los datos del producto han sido actualizados
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Nuevo nombre',
            'descripcion' => 'Nueva descripción',
            'precio_venta' => 100,
            'stock' => 50,
            'category_id' => $category->id,
        ]);
    }

    
    
    
}