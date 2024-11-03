<?php

namespace App\Livewire\Sale;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;

class ProductRow extends Component
{
    public Product $product;
    public $stock;
    public $stockLabel;

    protected function getListeners()
    {
        return[
            "decrementStock.{$this->product->id}" => "decrementStock",
            "incrementStock.{$this->product->id}" =>"incrementStock",
            "refreshProducts" => "mount",
            "devolverStock.{$this->product->id}" => "devolverStock",
            // "refreshProducts" => "refreshStock"
        ];
    }

    public function render()
    {
        $this->stockLabel = $this->stockLabel();
        return view('livewire.sale.product-row');
    }

    public function mount(){

        $this->stock= $this->product->stock;
        $this->render();

    }

    public function addProduct(Product $product){

        if($this->stock==0){
            return;
        }
        $this->dispatch('add-product',$product);
        $this->stock--; //descontamos una unidad al agregar un producto
    }


    public function decrementStock(){
        $this->stock--;
    }

    public function incrementStock(){
        if($this->stock==$this->product->stock-1){
            return;
        }else{
            $this->stock++;
        }
       
    }


    public function devolverStock($qty){

        $this->stock = $this->stock+$qty;

       
    }

    public function stockLabel(){

        if($this->stock<=$this->product->stock_minimo){
            return '<span class="badge badge-pill badge-danger">'.$this->stock.'</span>';
        }else{
            return '<span class="badge badge-pill badge-success">'.$this->stock.'</span>';
        }
    }

    //  public function refreshStock()
    //  {
    //      $this->stock = $this->product->fresh()->stock; // Recargar el stock real desde la base de datos
    //      $this->render(); // Actualizar el renderizado del componente
    //  }

}
