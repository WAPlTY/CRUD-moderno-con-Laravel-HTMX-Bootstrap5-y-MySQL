<div class="text-center mb-3">
   <h4>{{ $empleado->nombre }}</h4>
   <p class="text-muted">{{ $empleado->cargo }}</p>
</div>
<div class="row">
    <div class="col-md-4 text-center">
        @if($empleado->avatar)
            <img src="{{ asset('avatars/' . $empleado->avatar) }}" alt="Avatar" class="img-fluid rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;" />
        @else
            <img src="https://www.drmarket.com.mx/Archivos/Anuncios/sinImagenDefault.jpg" alt="Avatar" class="img-fluid rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;" />
        @endif
    </div>
    <div class="col-md-8">
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between">
                <span>Edad:</span>
                <strong>{{ $empleado->edad }} años</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>Cédula:</span>
                <strong>{{ $empleado->cedula }}</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>Sexo:</span>
                <strong>{{ $empleado->sexo }}</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>Teléfono:</span>
                <strong>{{ $empleado->telefono }}</strong>
            </li>
        </ul>
    </div>
</div>