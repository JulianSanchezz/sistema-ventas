<div>


    <x-card cardTitle='Listado Categorias ({{$this->totalRegistros}})'> {{-- pasamos los nombres a las variables de lo que deseamos en el titulo del componente--}}
 
             <x-slot:cardTools>
                   <a href="#" class="btn btn-primary" wire:click='create'>
                    <i class="fas fa-plus-circle"></i>Crear Categoria</a>
             </x-slot:cardTools>
                
             <x-table>
                <x-slot:thead>
                   <th>Id</th>
                   <th>Nombre</th>
                   <th width="3%">...</th>
                   <th width="3%">...</th>
                   <th width="3%">...</th>
                  
                </x-slot:thead>
             
                @forelse ($categories as $category)
                    
                
                      <tr>
                         <td>{{$category->id}}</td>
                         <td>{{$category->name}}</td>
                         <td>
                            <a href="{{route('categories.show',$category)}}" title="Ver" class="btn btn-success btn-xs">
                                <i class="far fa-eye"></i>
                            </a>
                        </td>
                         <td>
                            <a href="#" wire:click='edit({{$category->id}})' title="Editar" class="btn btn-primary btn-xs">
                                <i class="far fa-edit"></i>
                            </a>
                         </td>
                         <td>
                            <a wire:click="$dispatch('delete', { id: {{$category->id}}, eventName: 'destroyCategory' })" title="Eliminar" class="btn btn-danger btn-xs">
                                <i class="far fa-trash-alt"></i>
                            </a>                            
                         </td>
                      </tr>
                      @empty
                          <tr class="text-center">
                            <td colspan="5">
                                Sin registros
                            </td>
                          </tr>
                      @endforelse           
             </x-table>

             <x-slot:cardFooter>
                {{$categories->links()}} <!-- logica pagination-->
             </x-slot>

    </x-card>


        <x-modal modalId="modalCategory" modalTitle="Categorias">
            <form wire:submit.prevent="{{ $Id == 0 ? 'store' : 'update(' . $Id . ')' }}">
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="name">Nombre:</label>
                        <input wire:model='name' type="text" class="form-control" placeholder="Nombre categoria" id="name">
                        @error('name')
                            <div class="alert alert-danger w-100 mt-3">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <hr>
                <button class="btn btn-primary float-right">{{ $Id == 0 ? 'Guardar' : 'Editar' }}</button>

            </form>
        </x-modal>
 </div>
 