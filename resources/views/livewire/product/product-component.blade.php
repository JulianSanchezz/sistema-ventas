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
                         <td>imagen</td>
                         <td>{{$product->name}}</td>
                         <td>{{$product->precio_venta}}</td>
                         <td>{{$product->stock}}</td>
                         <td>{{$product->category_id}}</td>
                         <td>Active</td>
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
 