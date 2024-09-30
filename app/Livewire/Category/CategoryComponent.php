<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Categorias')]
class CategoryComponent extends Component
{
    //Propiedades clase
    public $totalRegistros=0;

    //Propiedades modelo
    public $name;

    public function render()
    {
        return view('livewire.category.category-component');
    }

    public function mount(){
        $this->totalRegistros = Category::count();
    }

    //crear categoria
    public function store(){
        //dump('crear category');
        $rules = [
            'name' => 'required|min:5|max:55|unique:categories'
        ];
        $message = [
            'name.required' => 'El nombre es requerido',
            'name.min' => 'Debe tener minimo 5 caracteres',
            'name.max' => 'No debe superar los 255 caracteres',
            'name.unique' => 'El nombre de la categoria ya esta en uso'
        ];
        $this->validate($rules, $message);

        $category = new Category();
        $category->name = $this->name;
        $category->save();

        $this->dispatch('close-modal','modalCategory');
    }
}
