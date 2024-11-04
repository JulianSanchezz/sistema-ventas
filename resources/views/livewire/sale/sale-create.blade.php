<div>
    <x-card cardTitle="">
       <x-slot:cardTools>
          <a href="{{route('sales.list')}}" class="btn btn-primary btn-sm mr-2">
            <i class="fas fa-shopping-cart"></i> Ir a Ventas 
          </a>

          <a href="#" class="btn-sm btn btn-danger" wire:click='clear'>
            <i class="fas fa-trash"></i> Cancelar Venta 
          </a>
       </x-slot>
       {{-- contenido principal --}}
       <div class="row">
            {{-- columna detalles ventas --}}
            <div class="col-md-6"> 
                {{-- card datails : --}}
                @include('sales.card-details')
                {{-- card pago : --}}
                @include('sales.card-pago')
                {{-- card cliente --}}
                @livewire('sale.client')

            </div>
            {{-- columna productos --}}
            <div class="col-md-6"> 
                @include('sales.list-products')
            </div>
            
       </div>

       <x-slot:cardFooter>
            
       </x-slot>
    </x-card>

</div>
