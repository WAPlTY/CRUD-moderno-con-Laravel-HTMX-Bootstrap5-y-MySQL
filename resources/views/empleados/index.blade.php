<div class="table-responsive" id="empleados-table">
    <table class="table table-hover table-striped" id="table_empleados">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Edad</th>
                <th scope="col">Cédula</th>
                <th scope="col">Cargo</th>
                <th scope="col">Avatar</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
                @include('empleados.table-rows')
            </tbody>
    </table>
</div>
