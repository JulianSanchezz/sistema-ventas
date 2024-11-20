<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Livewire\Attributes\On;

use function Laravel\Prompts\error;

#[Title('Categorias')]
class CategoryComponent extends Component
{
    use WithPagination;

    //Propiedades clase
    public $search = '';
    public $totalRegistros = 0;
    public $cant = 5;

    //Propiedades modelo
    public $name;
    public $Id;

    public function render()
    {
        if ($this->search != '') {
            $this->resetPage(); //resetamos la pagina si es diferente de vacio
        }
        $this->totalRegistros = Category::count();

        // Modificamos para mostrar todas las categorías, pero las desactivadas al final
        $categories = Category::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('categoriaEstado', 'desc') // Las activas primero
            ->orderBy('id', 'desc')
            ->paginate($this->cant);

        return view('livewire.category.category-component', ['categories' => $categories]);
    }

    public function mount() {}

    public function create()
    {

        $this->Id = 0;
        $this->reset(['name']);
        $this->resetErrorBag();
        $this->dispatch('open-modal', 'modalCategory');
    }

    //crear categoria
    public function store()
    {
        // Validación personalizada para verificar si la categoría está inactiva o ya existe activada
        $rules = [
            'name' => 'required|min:5|max:55'
        ];

        $message = [
            'name.required' => 'El nombre es requerido',
            'name.min' => 'Debe tener mínimo 5 caracteres',
            'name.max' => 'No debe superar los 255 caracteres',
        ];

        $this->validate($rules, $message);

        // Verificar si la categoría existe activada
        $category = Category::where('name', $this->name)
            ->where('categoriaEstado', true)
            ->first();

        if ($category) {
            // Si ya está activada, no se permite crearla de nuevo
            $this->dispatch('msg', 'La categoría ya está activada');
            return;
        }

        // Verificar si la categoría existe desactivada
        $inactiveCategory = Category::where('name', $this->name)
            ->where('categoriaEstado', false)
            ->first();

        if ($inactiveCategory) {
            // Si la categoría está inactiva, se reactiva
            $inactiveCategory->categoriaEstado = true;
            $inactiveCategory->updated_at = now(); // Actualizamos la fecha de modificación
            $inactiveCategory->save();

            $this->dispatch('msg', 'Categoría reactivada correctamente');
            $this->reset(['name']);
            return; // Salir, ya que no necesitamos crear una nueva categoría
        }

        // Validar que el nombre no contenga números
        if (preg_match('/\d/', $this->name)) {
            $this->dispatch('msg', 'El nombre de la categoría no debe contener números', 'error');
            return;
        }

        // Si no existe ni activa ni inactiva, creamos una nueva categoría
        $newCategory = new Category();
        $newCategory->name = $this->name;
        $newCategory->categoriaEstado = true; // Por defecto, la categoría está activa
        $newCategory->save();

        $this->dispatch('close-modal', 'modalCategory');
        $this->dispatch('msg', 'Categoría creada correctamente');
        $this->reset(['name']);
    }


    public function update(Category $category)
    {
        // Modificar la validación para excluir las categorías inactivas
        $rules = [
            'name' => 'required|min:5|max:55|unique:categories,name,' . $this->Id . ',id,categoriaEstado,true'
        ];
        $message = [
            'name.required' => 'El nombre es requerido',
            'name.min' => 'Debe tener minimo 5 caracteres',
            'name.max' => 'No debe superar los 255 caracteres',
            'name.unique' => 'El nombre de la categoria ya esta en uso'
        ];
        $this->validate($rules, $message);

        $category->name = $this->name;
        $category->update();

        $this->dispatch('close-modal', 'modalCategory');
        $this->dispatch('msg', 'Categoria editada correctamente');

        $this->reset(['name']);
    }


    // #[On('destroyCategory')] //damos de baja la categoria
    // public function destroy($id)
    // {
    //     // Instanciamos el modelo de category
    //     $category = Category::findOrFail($id);

    //     // Baja lógica: actualizamos la columna categoriaEstado a false
    //     $category->categoriaEstado = false;
    //     $category->save();

    //     $this->dispatch('msg', 'Categoria desactivada correctamente');
    // }

    #[On('destroyCategory')] // Damos de baja la categoría
    public function destroy($id)
    {
        // Instanciamos el modelo de category
        $category = Category::findOrFail($id);

        // Verificar si tiene productos activos relacionados
        $activeProducts = $category->products()->where('active', true)->count();

        if ($activeProducts > 0) {
            $this->dispatch('msg', "No puedes desactivar esta categoría porque tiene $activeProducts productos activos.", 'error');
            return;
        }

        // Baja lógica: actualizamos la columna categoriaEstado a false
        $category->categoriaEstado = false;
        $category->save();

        $this->dispatch('msg', 'Categoría desactivada correctamente.', 'success');
    }


    public function edit($categoryId)
    {
        // Buscar la categoría por el ID
        $category = Category::find($categoryId);
        $this->Id = $category->id;
        $this->name = $category->name;
        // Mostrar el modal para editar
        $this->dispatch('open-modal', 'modalCategory');
    }


    public function activate($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $category->categoriaEstado = true;
        $category->save();

        $this->dispatch('msg', 'Categoria restaurado correctamente.');
    }


}
