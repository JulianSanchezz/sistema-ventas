<?php

namespace App\Livewire\Sale;

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cart;
use Livewire\Attributes\On;

#[Title('Ventas')]
class SaleCreate extends Component
{
    use WithPagination;

    //Propiedades clase
    public $search='';
    public $cant=5;
    public $totalRegistros=0;
    //Propiedades pago
    public $pago=0;
    public $devuelve=0;
    public $updating=0;

    public $client=1;

    public function render()
    {

        if($this->search!=''){
            $this->resetPage();

        }
        $this->totalRegistros = Product::count();

        
        return view('livewire.sale.sale-create',[
            'products' => $this->products,
            'cart' => Cart::getCart(),
            'total' => Cart::getTotal(),
            'totalArticulos' => Cart::totalArticulos()
        ]);
    
    }

    #[On('add-product')]
    public function addProduct(Product $product){

        // dump($product);
        Cart::add($product);

    }

    //decrementar cantidad
    public function decrement($id){

        Cart::decrement($id);
        $this->dispatch("incrementStock.{$id}");
    }


    //incrementar cantidad
    public function increment($id){
        Cart::increment($id);
        $this->dispatch("decrementStock.{$id}");
    }


    //Eliminar item de carrito
    public function removeItem($id,$qty){

        Cart::removeItem($id);
        $this->dispatch("devolverStock.{$id}",$qty);
    }

    //cancelar venta/limpiar
    public function clear(){

        Cart::clear();
        $this->dispatch('msg', 'Venta Cancelada');
        $this->dispatch('refreshProducts');
    }

    #variable computada
    #obtenemos el listado de productos
    #[Computed()]
    public function products() {

        return Product::where('name','like','%'.$this->search.'%')
        ->orderBy('id','desc')
        ->paginate($this->cant);

    }


}
