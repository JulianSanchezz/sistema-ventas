<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Productos')]
class ProductComponent extends Component
{
    //propiedades clase
    public $search='';
    public $totalRegistros=0;
    public $cant=5;

    //propiedades modelo
    public $Id=0;
    public $name;
    public $category_id;
    public $descripcion;
    public $precio_compra;
    public $precio_venta;
    public $codigo_barras;
    public $stock=10;
    public $stock_minimo;
    public $fecha_vencimiento;
    public $active=1;
    public $image;

    public function render()
    {
        $this->dispatch('open-modal','modalProduct');

        $this->totalRegistros = Product::count();

        $products = Product::where('name', 'like', '%'. $this->search .'%')
        ->orderBy('id','desc')
        ->paginate($this->cant);

        
        return view('livewire.product.product-component', ['products' => $products]);
    }


    public function create(){

        $this->Id=0;
        $this->reset(['name']);
        $this->resetErrorBag();
        $this->dispatch('open-modal','modalProduct');

    }

    //crear productos
    public function store(){
        //dump('crear producto');
         $rules = [
             'name' => 'required|min:5|max:55|unique:products',
             'descripcion' => 'max:255',
             'precio_compra' => 'numeric|nullable',
             'precio_venta' => 'required|numeric',
             'stock' => 'required|numeric',
             'stock_minimo' => 'numeric|nullable',
             'image' => 'image|max:1024|nullable',
             'category_id' => 'required|numeric',
         ];
        //  $message = [
        //      'name.required' => 'El nombre es requerido',
        //      'name.min' => 'Debe tener minimo 5 caracteres',
        //      'name.max' => 'No debe superar los 255 caracteres',
        //      'name.unique' => 'El nombre de la categoria ya esta en uso'
        //  ];

         $this->validate($rules);

        // $category = new Product();
        // $category->name = $this->name;
        // $category->save();

        // $this->dispatch('close-modal','modalCategory');
        // $this->dispatch('msg','Categoria creada correctamente');

        // $this->reset(['name']);

    }

}
