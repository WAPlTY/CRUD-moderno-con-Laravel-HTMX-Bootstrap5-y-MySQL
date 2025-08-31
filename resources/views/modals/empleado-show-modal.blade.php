<!-- Modal completa para mostrar detalles del empleado -->
<div class="modal fade" id="empleadoModal" tabindex="-1" aria-labelledby="empleadoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title w-100 text-center" id="empleadoModalLabel">Detalles del Empleado</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i>
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>