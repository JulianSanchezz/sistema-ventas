<x-card cardTitle='Detalles de la Categoria'>
    <x-slot:cardTools>
        <a href="{{ route('categories') }}" class="btn btn-primary">
            <i class="fas fa-arrow-circle-left"></i> Regresar</a>

    </x-slot>

    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">

                    <h2 class="profile-username text-center">{{ $category->name }}</h2>


                    <ul class="list-group mb-3">
                        <li class="list-group-item">
                            <b>Productos</b> <a class="float-right">0</a>
                        </li>
                        <li class="list-group-item">
                            <b>Articulos</b> <a class="float-right">0</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col md-8">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imagen</th>
                        <th>Producto</th>
                        <th>Precio Venta</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-card>
