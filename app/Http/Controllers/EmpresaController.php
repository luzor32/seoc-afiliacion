<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;

class EmpresaController extends Controller
{
    // Listado de empresas
    public function index()
    {
        $empresas = Empresa::all();
        return view('empresas.index', compact('empresas'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('empresas.create');
    }

    // Guardar nueva empresa
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cuit' => 'required|string|unique:empresas,cuit',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:50',
            'email' => 'nullable|email',
            'actividad' => 'nullable|string|max:255',
            'estado' => 'required|in:activa,inactiva',
        ]);

        Empresa::create($request->all());

        return redirect()->route('empresas.index')
            ->with('mensaje', 'Empresa creada correctamente');
    }

    // Mostrar formulario de edición
    public function edit(Empresa $empresa)
    {
        return view('empresas.edit', compact('empresa'));
    }

    // Actualizar empresa
    public function update(Request $request, Empresa $empresa)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cuit' => 'required|string|unique:empresas,cuit,' . $empresa->id,
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:50',
            'email' => 'nullable|email',
            'actividad' => 'nullable|string|max:255',
            'estado' => 'required|in:activa,inactiva',
        ]);

        $empresa->update($request->all());

        return redirect()->route('empresas.index')
            ->with('mensaje', 'Empresa actualizada correctamente');
    }

    // Eliminar empresa
    public function destroy(Empresa $empresa)
    {
        $empresa->delete();

        return redirect()->route('empresas.index')
            ->with('mensaje', 'Empresa eliminada correctamente');
    }
}
