<?php

namespace App\Livewire\Sale;

use Livewire\Component;
use Livewire\Attributes\Reactive;

class Currency extends Component
{
    #[Reactive]
    public $total;
    public $valores=[];

    public function render()
    {
        return view('livewire.sale.currency');
    }

    public function mount(){

        $this->valores =[
            10000,20000,30000
        ];

    }

    public function setPago($valor){
        //agregar nombre del evento y se envia el valor
        $this->dispatch('setPago',$valor);
        $this->dispatch('close-model','modalCurrency');
        //cerramos el modal luego de emitir el 1er evento

    }

    public function openModal(){
        $this->dispatch('open-modal','modalCurrency');
    }
}
