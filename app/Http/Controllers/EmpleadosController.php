<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmpleadosController extends Controller
{
    // Función para listar todos los empleados
    public function index()
    {
        $empleados = Empleados::all();
        return view('layouts.app', compact('empleados'));
    }

    // Función para crear un nuevo empleado
    public function store(Request $request)
    {
        $empleado = new Empleados();
        $empleado->nombre = $request->nombre;
        $empleado->cedula = $request->cedula;
        $empleado->edad = $request->edad;
        $empleado->sexo = $request->sexo;
        $empleado->telefono = $request->telefono;
        $empleado->cargo = $request->cargo;

        // Guardar el avatar si se ha subido
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $nombrearchivo = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('avatars'), $nombrearchivo);
            $empleado->avatar = $nombrearchivo;
        }

        $empleado->save(); // Guardar el empleado en la base de datos

        // Si la petición es hecha con HTMX (verificando el header 'HX-Request')
        if ($request->header('HX-Request')) {
            $empleados = Empleados::all(); // Obtener todos los empleados actualizados después de registrar uno nuevo

            // Devolver solo la parte de la tabla (sin recargar toda la página)
            return response()
                ->view('empleados.table-rows', compact('empleados')) // Renderiza solo las filas
                ->header('HX-Trigger', json_encode([
                    // Dispara un evento HTMX personalizado para mostrar una alerta de éxito
                    'showAlert' => 'Empleado registrado exitosamente.'
                ]));
        }

        return redirect()->back()->with('success', 'Empleado registrado exitosamente.');
    }

    // Función para mostrar un empleado de acuerdo al id del empleado recibido
    public function show(Request $request, $empleado)
    {
        $empleado = Empleados::findOrFail($empleado); // Buscar el empleado por ID
        
        // Si es una petición HTMX, retornar la modal completa
        if ($request->header('HX-Request')) {
            // Retornar la modal de visualización con la informacion del empleado
            return view('modals.empleado-show-modal', compact('empleado'));
        }
        
        return view('empleados.show', compact('empleado'));
    }

    // Función para editar un empleado de acuerdo al id del empleado recibido
    public function edit(Request $request, $idEmpleado)
    {
        $empleado = Empleados::findOrFail($idEmpleado); // Buscar el empleado por ID
        
        // Si es una petición HTMX, retornar la modal de edición
        if ($request->header('HX-Request')) {
            // Retornar la modal de edición con la informacion del empleado
            return view('modals.empleado-edit-modal', compact('empleado'));
        }
        
        return view('empleados.edit', compact('empleado'));
    }

    // Función para actualizar un empleado de acuerdo al id del empleado recibido
    public function update(Request $request, $idEmpleado)
    {
        $datoEmpleado = Empleados::findOrFail($idEmpleado); // Buscar el empleado por ID

        // Verificar si se adjuntó un nuevo archivo de imagen
        if ($request->hasFile('avatar')) {
            // Eliminar la imagen anterior del servidor si existe
            if ($datoEmpleado->avatar) {
                if (file_exists(public_path('avatars/' . $datoEmpleado->avatar))) {
                    unlink(public_path('avatars/' . $datoEmpleado->avatar));
                }
            }

            // Subir la nueva imagen
            $file = $request->file('avatar');
            $nombrearchivo = Str::random(20) . '.' . $file->getClientOriginalExtension(); // Generar un nombre aleatorio para el archivo
            $file->move(public_path('avatars'), $nombrearchivo); // Mover el archivo a la carpeta de avatares
            $datoEmpleado->avatar = $nombrearchivo; // Actualizar el nombre del archivo en la base de datos
        }

        // Actualizar los demás campos
        $datoEmpleado->nombre = $request->nombre;
        $datoEmpleado->cedula = $request->cedula;
        $datoEmpleado->edad = $request->edad;
        $datoEmpleado->sexo = $request->sexo;
        $datoEmpleado->telefono = $request->telefono;
        $datoEmpleado->cargo = $request->cargo;
        $datoEmpleado->save();

        // Si la petición viene desde HTMX (con el header 'HX-Request')
        if ($request->header('HX-Request')) {
            $empleados = Empleados::all(); // Consultar todos los empleados (o podrías filtrar según tu lógica)

            // Retornar solo las filas de la tabla (sin recargar toda la página)
            return response()
                ->view('empleados.table-rows', compact('empleados')) // Vista parcial con las filas
                ->header('HX-Trigger', json_encode([ 
                    // Enviar eventos personalizados a HTMX
                    'showAlert' => 'Empleado actualizado exitosamente.', // Muestra alerta
                    'closeModal' => 'empleadoEditModal' // Cierra el modal
                ]));
        }

        return redirect()->route('home')->with('success', 'Empleado actualizado exitosamente.');
    }

    // Función para eliminar un empleado de acuerdo al id del empleado recibido
    public function destroy(Request $request, $idEmpleado)
    {
        $empleado = Empleados::findOrFail($idEmpleado); // Buscar el empleado por ID
        // Verificar si el empleado existe
        if (!$empleado) {
            if ($request->header('HX-Request')) {
                return response()
                    ->json(['error' => 'Empleado no encontrado.'])
                    ->header('HX-Trigger-After-Swap', json_encode([
                        'showToast' => [
                            'message' => 'Empleado no encontrado.',
                            'type' => 'error'
                        ]
                    ]));
            }
            return redirect()->route('home')->with('error', 'Empleado no encontrado.');
        }

        // Elimina el archivo de imagen si existe
        if ($empleado->avatar) {
            $path = public_path('avatars/' . $empleado->avatar);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $empleado->delete();

        // Si la petición es realizada por HTMX (detectada con el header 'HX-Request')
        if (request()->header('HX-Request')) {
            $empleados = Empleados::all(); // Consultar todos los empleados actualizados después de eliminar

            // Retornar solo el fragmento de vista con las filas actualizadas de la tabla
            return response()
                ->view('empleados.table-rows', compact('empleados')) // Vista parcial de las filas
                ->header('HX-Trigger', json_encode([
                    // Evento personalizado para mostrar alerta de éxito
                    'showAlert' => 'Empleado eliminado exitosamente.'
                ]));
        }

        return redirect()->route('home')->with('success', 'Empleado eliminado exitosamente.');
    }

    // Función para confirmar la eliminación de un empleado
    public function confirmDelete($idEmpleado)
    {
        $empleado = Empleados::findOrFail($idEmpleado); // Buscar el empleado por ID
        return view('modals.confirm-delete-modal', compact('empleado')); // Retornar la modal de confirmación
    }
}
