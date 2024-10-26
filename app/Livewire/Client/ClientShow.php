<?php

namespace App\Livewire\Client;

use App\Models\Client;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Ver Cliente')]
class ClientShow extends Component
{
    public Client $client;

    public function render()
    {

        return view('livewire.client.client-show');
    }
}
