<div>
    <x-card cardTitle="">
       <x-slot:cardTools>
          <a href="#" class="btn btn-primary btn-sm mr-2">
            <i class="fas fa-plus-circle"></i> Ir a Ventas 
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
