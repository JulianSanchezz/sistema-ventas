<div>
    <x-card cardTitle='Listado Productos ({{$this->totalRegistros}})'> {{-- pasamos los nombres a las variables de lo que deseamos en el titulo del componente--}}
 
             <x-slot:cardTools>
                   <a href="#" class="btn btn-primary" wire:click='create'>
                    <i class="fas fa-plus-circle"></i>Crear Producto</a>
             </x-slot:cardTools>
                
             <x-table>
                <x-slot:thead>
                   <th>Id</th>
                   <th>Imagen</th>
                   <th>Nombre</th>
                   <th>Precio Venta</th>
                   <th>Stock</th>
                   <th>Categoria</th>
                   <th>Estado</th>
                   <th width="3%">...</th>
                   <th width="3%">...</th>
                   <th width="3%">...</th>
                  
                </x-slot:thead>
             
                @forelse ($products as $product)
                               
                      <tr>
                         <td>{{$product->id}}</td>
                         
                         <td>
                            <x-image :item="$product" />
                         </td>
                         <td>{{$product->name}}</td>
                         <td>{!! $product->precio !!}</td>
                         <td>{!! $product->stockLabel !!}</td>
                         <td>
                            <a class="badge badge-secondary" href="{{route('categories.show',$product->category->id)}}">{{$product->category->name}}</a>
                         </td>
                         <td>{!! $product->activeLabel !!}</td>
                         <td>
                            <a href="{{route('products.show',$product)}}" title="Ver" class="btn btn-success btn-xs">
                                <i class="far fa-eye"></i>
                            </a>
                        </td>
                         <td>
                            <a href="#" wire:click='edit({{$product->id}})' title="Editar" class="btn btn-primary btn-xs">
                                <i class="far fa-edit"></i>
                            </a>
                         </td>
                         <td>
                              <!--Emitemos un evento que pasamos el id del producto y segundo parametro el nombre del evento a ejecutar -->
                            <a wire:click="$dispatch('delete', { id: {{$product->id}}, eventName: 'destroyProduct' })" title="Eliminar" class="btn btn-danger btn-xs">
                                <i class="far fa-trash-alt"></i>
                            </a>                            
                         </td>
                      </tr>
                      @empty
                          <tr class="text-center">
                            <td colspan="10">
                                Sin registros
                            </td>
                          </tr>
                      @endforelse           
             </x-table>

             <x-slot:cardFooter>
                {{$products->links()}} <!-- logica pagination-->
             </x-slot>

    </x-card>


        @include('products.modal')
 </div>
 