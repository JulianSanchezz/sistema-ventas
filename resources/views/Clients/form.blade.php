<x-modal modalId="modalClient" modalTitle="Clientes">
    <form wire:submit={{$Id==0 ? "store" : "update($Id)"}}>
        <div class="form-row">

            {{-- INPUT NOMBRE --}}
            <div class="form-group col-md-6">
                <label for="name">Nombre:</label>
                <input wire:model='name' type="text" class="form-control" placeholder="Nombre" id="name" onkeypress="return /[a-zA-Z\s]/i.test(event.key)">
                @error('name')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>

            


             {{-- INPUT DNI --}}
             <div class="form-group col-md-6">
                <label for="identificacion">Dni:</label>
                <input wire:model='identificacion' type="text" class="form-control" placeholder="identificacion" id="identificacion" onkeypress="return /[0-9]/i.test(event.key)">
                @error('identificacion')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>

              {{-- INPUT MAIL --}}
              <div class="form-group col-md-6">
                <label for="identificacion">Email:</label>
                <input wire:model='email' type="email" class="form-control" placeholder="Email" id="email">
                @error('email')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>


              {{-- INPUT telefono --}}
              <div class="form-group col-md-6">
                <label for="telefono">Telefono:</label>
                <input wire:model='telefono' type="text" class="form-control" placeholder="Telefono" id="telefono" onkeypress="return /[0-9]/i.test(event.key)">
                @error('telefono')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>


            {{-- INPUT empresa --}}
            <div class="form-group col-md-6">
                <label for="empresa">Empresa:</label>
                <input wire:model='empresa' type="text" class="form-control" placeholder="Empresa" id="empresa">
                @error('empresa')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>

            {{-- INPUT CUIL --}}
            <div class="form-group col-md-6">
                <label for="cuit">Cuit/Cuil:</label>
                <input wire:model='cuit' type="text" class="form-control" placeholder="Cuit/Cuil" id="cuit" onkeypress="return /[0-9]/i.test(event.key)">
                @error('cuit')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>



        </div>
        
        <hr>
        <button class="btn btn-primary float-right">{{$Id==0 ? 'Guardar' : 'Editar'}}</button>    
    </form>
 </x-modal>