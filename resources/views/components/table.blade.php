<div class="mb-3 d-flex justify-content-between">
    <div>
        <span>Mostrar</span>
        <select>
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
        <span>entradas</span>
    </div>
    <div>
        <input type="text" class="form-control" placeholder="Buscar">
    </div>
</div>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                {{$thead}}
            </tr>
        </thead>
        <tbody>
            {{$slot}} {{-- viene la info de la bd--}}
        </tbody>
    </table>
</div>