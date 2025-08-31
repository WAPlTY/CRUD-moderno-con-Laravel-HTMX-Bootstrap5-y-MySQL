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
                        <img src="{{ asset('avatars/' . $empleado->avatar) }}" alt="Avatar" width="50" height="50" />
                        @else
                        <img src="https://www.drmarket.com.mx/Archivos/Anuncios/sinImagenDefault.jpg" alt="Avatar" width="50" height="50" />
                        @endif
                    </td>
                    <td>
                         <ul class="flex_acciones">
                            <li>
                                <a title="Ver detalles del empleado" 
                                   href="{{ route('myShow', $empleado->id)}}"
                                   hx-get="{{ route('myShow', $empleado->id)}}"
                                   hx-target=".modal_container"
                                   hx-swap="innerHTML"
                                   class="btn btn-success">
                                   <i class="bi bi-binoculars"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('myEdit', $empleado->id) }}"
                                   hx-get="{{ route('empleados.show', $empleado->id) }}"
                                   hx-target=".modal_container"
                                   hx-swap="innerHTML"
                                   class="btn btn-primary">
                                   <i class="bi bi-pencil-square"></i>
                                </a>   
                            </li>
                            <li>
                                <button type="button" 
                                        class="btn btn-danger"
                                        hx-get="{{ route('empleados.confirm-delete', $empleado->id) }}"
                                        hx-target=".modal_container"
                                        hx-swap="innerHTML"
                                        title="Eliminar empleado">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </li>
                        </ul>
                    </td>
                </tr>
@endforeach