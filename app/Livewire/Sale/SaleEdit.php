<?php

namespace App\Livewire\Sale;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Title('Editar venta')]
class SaleEdit extends Component
{

    
    public function render()
    {
        return view('livewire.sale.sale-edit');
    }

    
}
