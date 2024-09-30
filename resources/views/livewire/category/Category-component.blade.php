<div>


    <x-card cardTitle='Listado Categorias ({{$this->totalRegistros}})' cardFooter=''> {{-- pasamos los nombres a las variables de lo que deseamos en el titulo del componente--}}
 
             <x-slot:cardTools>
                   <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalCategory">Crear Categoria</a>
             </x-slot:cardTools>
                
             <x-table>
                <x-slot:thead>
                   <th>Id</th>
                   <th>Nombre</th>
                   <th width="3%">...</th>
                   <th width="3%">...</th>
                   <th width="3%">...</th>
                  
                </x-slot:thead>
             
                      <tr>
                         <td>...</td>
                         <td>...</td>
                         <td>
                            <a href="#" title="Ver" class="btn btn-success btn-xs">
                                <i class="far fa-eye"></i>
                            </a>
                        </td>
                         <td>
                            <a href="#" title="Editar" class="btn btn-primary btn-xs">
                                <i class="far fa-edit"></i>
                            </a>
                         </td>
                         <td>
                            <a href="#" title="Eliminar" class="btn btn-danger btn-xs">
                                <i class="far fa-trash-alt"></i>
                            </a>
                         </td>
                      </tr>            
             </x-table>
    </x-card>


        <x-modal modalId="modalCategory" modalTitle="Categorias">
            <form wire:submit="store">
                <div class="row">
                    <div class="col">
                        <input wire:model='name' type="text" class="form-control" placeholder="Nombre categoria">
                        @error('name')
                            <div class="alert alert-danger w-100 mt-3">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <hr>
                <button class="btn btn-primary float-right">Guardar</button>
            </form>
        </x-modal>
 </div>
 