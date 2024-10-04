<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Livewire\Attributes\On;


#[Title('Categorias')]
class CategoryComponent extends Component
{
    use WithPagination;

    //Propiedades clase
    public $search='';
    public $totalRegistros=0;
    public $cant=5;
    

    //Propiedades modelo
    public $name;
    public $Id;

    public function render()
    {
        if($this->search!=''){
            $this->resetPage(); //resetamos la pagina si es diferente de vacio
        }
        $this->totalRegistros = Category::count();

        $categories = Category::where('name', 'like', '%'. $this->search .'%')
        ->orderBy('id','desc')
        ->paginate($this->cant);
            


        return view('livewire.category.category-component', ['categories' => $categories]);
        
    }

    public function mount(){
        
    }

    public function create(){

        $this->Id=0;
        $this->reset(['name']);
        $this->resetErrorBag();
        $this->dispatch('open-modal','modalCategory');

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
        $this->dispatch('msg','Categoria creada correctamente');

        $this->reset(['name']);

    }

    public function edit(Category $category){
            $this->Id = $category->id;
            $this->name = $category->name; //almacenamos lo que hay en el objeto categoria luego de llenar el form se abre el formulario.
            $this->dispatch('open-modal','modalCategory');
            


            //dump($category);
    }

    public function update(Category $category){
        //dump($category);

        $rules = [
            'name' => 'required|min:5|max:55|unique:categories,id,'.$this->Id
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
        $this->dispatch('close-modal','modalCategory');
        $this->dispatch('msg','Categoria editada correctamente');

        $this->reset(['name']);

    }

    #[On('destroyCategory')]
    public function destroy($id){

        //dump($id);
        //instanciamos el modelo de category
        $category = Category::findOrfail($id); 
        $category->delete();
        //Despues de eliminarse se dispara el dispatch
        $this->dispatch('msg','Categoria eliminada correctamente');
    }

}
