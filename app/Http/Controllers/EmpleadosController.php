<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmpleadosController extends Controller
{
    public function index()
    {
        $empleados = Empleados::all();
        return view('layouts.app', compact('empleados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $empleado = new Empleados();
        $empleado->nombre = $request->nombre;
        $empleado->cedula = $request->cedula;
        $empleado->edad = $request->edad;
        $empleado->sexo = $request->sexo;
        $empleado->telefono = $request->telefono;
        $empleado->cargo = $request->cargo;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $nombrearchivo = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('avatars'), $nombrearchivo);
            $empleado->avatar = $nombrearchivo;
        }

        $empleado->save();

        // Si es una petición HTMX, retornar solo las filas de la tabla
        if ($request->header('HX-Request')) {
            $empleados = Empleados::all();
            return response()
                ->view('empleados.table-rows', compact('empleados')) // Solo las filas, no toda la página
                ->header('HX-Trigger', json_encode(['showAlert' => 'Empleado registrado exitosamente.'])); // Envía mensaje al frontend
        }

        return redirect()->back()->with('success', 'Empleado registrado exitosamente.');
    }


    public function show(Request $request, $empleado)
    {
        $empleado = Empleados::findOrFail($empleado);
        
        // Si es una petición HTMX, retornar la modal completa
        if ($request->header('HX-Request')) {
            return view('modals.empleado-show-modal', compact('empleado'));
        }
        
        return view('empleados.show', compact('empleado'));
    }


    public function edit(Request $request, $idEmpleado)
    {
        $empleado = Empleados::findOrFail($idEmpleado);
        
        // Si es una petición HTMX, retornar solo el formulario
        if ($request->header('HX-Request')) {
            return view('empleados.edit-form', compact('empleado'));
        }
        
        return view('empleados.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idEmpleado)
    {
        $datoEmpleado = Empleados::findOrFail($idEmpleado);

        // Verificar si se adjuntó un nuevo archivo de imagen
        if ($request->hasFile('avatar')) {
            // Eliminar la imagen anterior del servidor si existe
            if ($datoEmpleado->avatar) {
                if (file_exists(public_path('avatars/' . $datoEmpleado->avatar))) {
                    unlink(public_path('avatars/' . $datoEmpleado->avatar));
                }
            }

            $file = $request->file('avatar');
            $nombrearchivo = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('avatars'), $nombrearchivo);
            $datoEmpleado->avatar = $nombrearchivo;
        }

        $datoEmpleado->nombre = $request->nombre;
        $datoEmpleado->cedula = $request->cedula;
        $datoEmpleado->edad = $request->edad;
        $datoEmpleado->sexo = $request->sexo;
        $datoEmpleado->telefono = $request->telefono;
        $datoEmpleado->cargo = $request->cargo;
        $datoEmpleado->save();

        // Si es una petición HTMX, retornar solo las filas de la tabla
        if ($request->header('HX-Request')) {
            $empleados = Empleados::all();
            return response()
                ->view('empleados.table-rows', compact('empleados'))
                ->header('HX-Trigger', json_encode(['showAlert' => 'Empleado actualizado exitosamente.']));
        }

        return redirect()->route('home')->with('success', 'Empleado actualizado exitosamente.');
    }


    public function destroy(Request $request, $idEmpleado)
    {
        $empleado = Empleados::find($idEmpleado);

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

        // Si es una petición HTMX, retornar solo las filas de la tabla
        if (request()->header('HX-Request')) {
            $empleados = Empleados::all();
            return response()
                ->view('empleados.table-rows', compact('empleados'))
                ->header('HX-Trigger', json_encode(['showAlert' => 'Empleado eliminado exitosamente.']));
        }

        return redirect()->route('home')->with('success', 'Empleado eliminado exitosamente.');
    }

    /**
     * Show confirmation modal for delete.
     */
    public function confirmDelete($idEmpleado)
    {
        $empleado = Empleados::findOrFail($idEmpleado);
        return view('modals.confirm-delete-modal', compact('empleado'));
    }
}
