<?php

namespace App\Livewire\Sale;

use App\Models\Sale;
use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;

#[Title('Ventas')]
class SaleList extends Component
{
    use WithPagination;

    //propiedades clase
    public $search='';
    public $totalRegistros=0;
    public $cant=5;

    public $totalVentas=0;
    public $dateInicio;
    public $dateFin;


    public function render()
    {
        
        if($this->search!=''){
            $this->resetPage(); //resetamos la pagina si es diferente de vacio
        }

        $this->totalRegistros = Sale::count();
         $salesQuery = Sale::where('id', 'like', '%'. $this->search .'%');


        if($this->dateInicio && $this->dateFin){
            $salesQuery = $salesQuery->whereBetween('fecha',[$this->dateInicio,$this->dateFin]);

            $this->totalVentas = $salesQuery->sum('total');
        }else{

            $this->totalVentas = Sale::sum('total');
        }
         
        $sales= $salesQuery 
        ->orderBy('id','desc')
        ->paginate($this->cant);

        return view('livewire.sale.sale-list',[
            "sales" => $sales
        ]);

    }

    // escuchamos el evento con el nombre destroySale
    #[On('destroySale')]
    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);

        if ($sale->items) {
            foreach ($sale->items as $item) {
                Product::find($item->id)->increment('stock', $item->pivot->qty); // Usamos pivot para acceder a qty
                $item->delete();
            }
        }

        $sale->delete();

        $this->dispatch('msg', 'Venta Eliminada');
    }

    #[On('setDates')]
    public function setDates($fechaInicio,$fechaFinal){

    $this->dateInicio = $fechaInicio;
    $this->dateFin = $fechaFinal;

    }

}
