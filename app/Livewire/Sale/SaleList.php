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
            if ($this->search != '') {
                $this->resetPage(); // Resetear la página si el campo de búsqueda no está vacío
            }

            // Total de registros activos
            $this->totalRegistros = Sale::where('estadoVenta', true)->count();

            // Consulta base: Solo ventas activas
            $salesQuery = Sale::where('estadoVenta', true)
                ->where('id', 'like', '%' . $this->search . '%');

            if ($this->dateInicio && $this->dateFin) {
                // Filtrar por rango de fechas
                $salesQuery = $salesQuery->whereBetween('fecha', [$this->dateInicio, $this->dateFin]);

                // Total de ventas activas dentro del rango
                $this->totalVentas = $salesQuery->sum('total');
            } else {
                // Total de ventas activas sin filtro de fechas
                $this->totalVentas = Sale::where('estadoVenta', true)->sum('total');
            }

            // Paginación y ordenamiento
            $sales = $salesQuery
                ->orderBy('id', 'desc')
                ->paginate($this->cant);

            // Retornamos la vista con las ventas activas
            return view('livewire.sale.sale-list', [
                "sales" => $sales
            ]);
        }


    // escuchamos el evento con el nombre destroySale
    // Escuchamos el evento con el nombre destroySale
        #[On('destroySale')]
        public function destroy($id)
        {
            $sale = Sale::findOrFail($id);

            if ($sale->items) {
                foreach ($sale->items as $item) {
                    $product = Product::find($item->id);
                    if ($product) {
                        $product->increment('stock', $item->pivot->qty); // Incrementamos el stock
                    }
                }
            }

            // Realizamos la baja lógica de la venta
            $sale->update(['estadoVenta' => false]);

            // Enviamos un mensaje de éxito
            $this->dispatch('msg', 'Venta dada de baja de forma lógica.');
        }


    #[On('setDates')]
    public function setDates($fechaInicio,$fechaFinal){

    $this->dateInicio = $fechaInicio;
    $this->dateFin = $fechaFinal;

    }

}
