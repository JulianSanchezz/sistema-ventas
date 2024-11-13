<div>

   <x-card cardTitle='Bienvenidos' cardFooter='card footer'> {{-- pasamos los nombres a las variables de lo que deseamos en el titulo del componente--}}

            <x-slot:cardTools>
                  <a href="{{route('sales.list')}}" class="btn btn-primary">
                     <i class="fas fa-shopping-cart"></i>Ir a Ventas
                  </a>

                  <a href="{{route('sales.create')}}" class="btn bg-purple"> <i class="fas fa-cart-plus"></i>Crear Ventas
                  </a>
            </x-slot:cardTools>

            {{-- filas de cards ventas hoy --}}
            @include('home.row-cards-sales')


            {{-- card grafica --}}
            @include('home.card-graph')

            {{-- cajas de reportes --}}
            @include('home.boxes-reports')

            {{-- filas de cards mejores vendedores y compradores --}}
            @include('home.best-sellers-buyers')

            
            
   </x-card>
</div>
