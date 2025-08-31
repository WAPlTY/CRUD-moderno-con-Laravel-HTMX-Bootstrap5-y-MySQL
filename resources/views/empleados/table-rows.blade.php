@foreach($empleados as $empleado)
    <tr id="empleado_{{ $empleado->id }}">
        <td>{{ $empleado->id }}</td>
        <td>{{ $empleado->nombre }}</td>
        <td>{{ $empleado->edad }}</td>
        <td>{{ $empleado->cedula }}</td>
        <td>{{ $empleado->cargo }}</td>
        <td>
            @if($empleado->avatar)
            <!--
            El helper asset generará la URL completa a la carpeta de avatares, asegurando que las imágenes se carguen correctamente independientemente de la ruta en la que te encuentres dentro de tu aplicación Laravel.
            -->
            <img class="rounded-circle" src="{{ asset('avatars/' . $empleado->avatar) }}" alt="{{ $empleado->nombre }}" width="50" height="50" loading="lazy" />
            @else
            <img class="rounded-circle" src="{{ asset('imgs/sin-foto.png') }}" alt="{{ $empleado->nombre }}" width="50" height="50" loading="lazy" />
            @endif
        </td>
        <td>
                <ul class="flex_acciones list-unstyled d-flex gap-1 m-0">
                <li>
                    <a title="Ver detalles del empleado" 
                    hx-get="{{ route('myShow', $empleado->id) }}"
                    hx-trigger="click"
                    hx-target=".modal_container"
                    hx-swap="innerHTML"
                    class="btn btn-success rounded-circle d-flex align-items-center justify-content-center p-1"
                    style="width: 36px; height: 36px;">
                    <i class="bi bi-binoculars"></i>
                    </a>
                </li>
                <li>
                    <a href="#"
                    hx-get="{{ route('myEdit', $empleado->id) }}"
                    hx-trigger="click"
                    hx-target=".modal_container"
                    hx-swap="innerHTML"
                    class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center p-1"
                    style="width: 36px; height: 36px;">
                    <i class="bi bi-pencil-square"></i>
                    </a>
                </li>
                <li>
                    <button type="button" 
                            class="btn btn-danger rounded-circle d-flex align-items-center justify-content-center p-1"
                            hx-get="{{ route('empleados.confirm-delete', $empleado->id) }}"
                            hx-target=".modal_container"
                            hx-trigger="click"
                            hx-swap="innerHTML"
                            title="Eliminar empleado"
                            style="width: 36px; height: 36px;">
                        <i class="bi bi-trash"></i>
                    </button>
                </li>
            </ul>
        </td>
    </tr>
@endforeach