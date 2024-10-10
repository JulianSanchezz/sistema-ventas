<x-modal modalId="modalProduct" modalTitle="Productos" modalSize="modal-lg">
    <form wire:submit.prevent="{{ $Id == 0 ? 'store' : 'update(' . $Id . ')' }}">
        <div class="form-row">
            {{-- input nombre --}}
            <div class="form-group col-md-7">
                <label for="name">Nombre:</label>
                <input wire:model='name' type="text" class="form-control" placeholder="Nombre producto" id="name">
                @error('name')
                    <div class="alert alert-danger w-100 mt-3">{{ $message }}</div>
                @enderror
            </div>

            {{-- select categoria --}}
            <div class="form-group col-md-5">
                <label for="category_id">Categoria:</label>
                
                <select wire:modeol='category_id' id="category_id" class="form-control">
                        <option value="0">Seleccionar</option>
                </select>

                @error('category_id')
                    <div class="alert alert-danger w-100 mt-3">{{ $message }}</div>
                @enderror
            </div>

            {{-- text area descripcion producto --}}
            <div class="form-group col-md-12">
                <label for="category_id">Descripcion:</label>
                
                <textarea wire:model='descripcion' id="descripcion" rows="3" class="form-control">

                </textarea>

                @error('descripcion')
                    <div class="alert alert-danger w-100 mt-3">{{ $message }}</div>
                @enderror
            </div>


             {{-- input precio compra --}}
             <div class="form-group col-md-4">
                <label for="precio_compra">Precio de compra:</label>
                <input wire:model='precio_compra' type="number" class="form-control" placeholder="Precio Compra" id="precio_compra">
                @error('precio_compra')
                    <div class="alert alert-danger w-100 mt-3">{{ $message }}</div>
                @enderror
            </div>


             {{-- input precio venta --}}
             <div class="form-group col-md-4">
                <label for="precio_venta">Precio de compra:</label>
                <input wire:model='precio_venta' type="number" class="form-control" placeholder="Precio Venta" id="precio_venta">
                @error('precio_venta')
                    <div class="alert alert-danger w-100 mt-3">{{ $message }}</div>
                @enderror
            </div>

            {{-- input cod de barras --}}
            <div class="form-group col-md-4">
                <label for="codigo_barras">Codigo de Barras:</label>
                <input wire:model='codigo_barras' type="text" class="form-control" placeholder="Codgio de Barras" id="codigo_barras">
                @error('codigo_barras')
                    <div class="alert alert-danger w-100 mt-3">{{ $message }}</div>
                @enderror
            </div>
            
            
            {{-- input stock --}}
            <div class="form-group col-md-4">
                <label for="stock">Stock:</label>
                <input wire:model='stock' type="number" class="form-control" placeholder="Stock" id="stock">
                @error('stock')
                    <div class="alert alert-danger w-100 mt-3">{{ $message }}</div>
                @enderror
            </div>

            {{-- input stock minimo --}}
            <div class="form-group col-md-4">
                <label for="stock_minimo">Stock Minimo:</label>
                <input wire:model='stock' type="number" class="form-control" placeholder="Stock minimo" id="stock_minimo">
                @error('stock_minimo')
                    <div class="alert alert-danger w-100 mt-3">{{ $message }}</div>
                @enderror
            </div>



            {{-- input fecha vencimiento --}}
            <div class="form-group col-md-4">
                <label for="fecha_vencimiento">Fecha Vencimiento</label>
                <input wire:model='fecha_vencimiento' type="date" class="form-control" placeholder="Fecha vencimiento" id="fecha_vencimiento">

                @error('fecha_vencimiento')
                    <div class="alert alert-danger w-100 mt-3">{{ $message }}</div>
                @enderror
            </div>

             {{-- activo check --}}
             <div class="form-group col-md-3">
                <div class="icheck-primary">
                    <input wire:model='active' type="checkbox" id="">
                    <label for="active">Esta activo?</label>
                </div>

                @error('active')
                    <div class="alert alert-danger w-100 mt-3">{{ $message }}</div>
                @enderror
            </div>


             {{-- input imagen --}}
             <div class="form-group col-md-3">
                
                <label for="image">Imagen</label>
                <input wire:model='image' type="file" id="image" accept="image/*">

                @error('image')
                    <div class="alert alert-danger w-100 mt-3">{{ $message }}</div>
                @enderror
            </div>


            {{-- mostrar imagen --}}
            <div class="form-group col-md-6">
                
                <img src="" alt="">
                
            </div>

        </div>

        <hr>
        <button class="btn btn-primary float-right">{{ $Id == 0 ? 'Guardar' : 'Editar' }}</button>

    </form>
</x-modal>
