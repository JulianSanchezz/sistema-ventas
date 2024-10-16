<?php

namespace App\Livewire\Product;

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Title('Productos')]
class ProductComponent extends Component
{

    use WithFileUploads;
    use WithPagination;

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
    public $stock=0;
    public $stock_minimo=10;
    public $fecha_vencimiento;
    public $active=1;
    public $image;

    public function render()
    {
        $this->totalRegistros = Product::count();

        $products = Product::where('name', 'like', '%'. $this->search .'%')
        ->orderBy('id','desc')
        ->paginate($this->cant);

        
        return view('livewire.product.product-component', ['products' => $products]);
    }

    #[Computed()] //propiedad computada
    public function categories(){
        return Category::all();
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

         $product = new Product();   
        
         $product->name = $this->name;
         $product->descripcion = $this->descripcion;
         $product->precio_compra = $this->precio_compra;
         $product->precio_venta = $this->precio_venta;
         $product->stock = $this->stock;
         $product->stock_minimo = $this->stock_minimo;
         $product->codigo_barras = $this->codigo_barras;
         $product->fecha_vencimiento = $this->fecha_vencimiento;
         $product->category_id = $this->category_id;
         $product->active = $this->active;
         $product->save();
         
         //si hay alguna imagen la procesamos. en la variable guardamos un nombre unico uniqid para la imagen definiendo un directorio products extraemos su extension y la subimos 
         if($this->image){
            $customName = 'products/'.uniqid().'.'.$this->image->extension();
            $this->image->storeAs('public',$customName);
            $product->image()->create(['url'=>$customName]);
            // Almacena la imagen asociada al producto usando la relación polimórfica
        }
        
         $this->dispatch('close-modal','modalProduct');
         $this->dispatch('msg','Producto creada correctamente');
         $this->clean();
    }

    public function clean(){
        $this->reset(['Id','name','image','descripcion','precio_compra','precio_venta','stock','stock_minimo','codigo_barras','fecha_vencimiento','active','category_id']);
    }

}
