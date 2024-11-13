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
        /**
         * Variable $sales
         *
         * Esta variable contiene los datos de ventas. Se utiliza típicamente para almacenar
         * información sobre las transacciones de ventas, como el monto, la fecha,
         * y los detalles de cada venta. Los datos pueden ser utilizados para generar informes,
         * analizar tendencias de ventas y otros propósitos de inteligencia empresarial.
         */

        $sales = $this->client->sales()->paginate(5);
        return view('livewire.client.client-show');
    }
}
