<?php

namespace App\Http\Controllers;

use App\Models\Beneficio;
use App\Models\Afiliado;
use Illuminate\Http\Request;

class BeneficioController extends Controller
{
    public function index()
    {
        $beneficios = Beneficio::all();
        return view('beneficios.index', compact('beneficios'));
    }

    public function create()
    {
        return view('beneficios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|boolean'
        ]);

        Beneficio::create($request->all());

        return redirect()->route('beneficios.index')
            ->with('success', 'Beneficio creado correctamente.');
    }

    public function edit(Beneficio $beneficio)
    {
        return view('beneficios.edit', compact('beneficio'));
    }

    public function update(Request $request, Beneficio $beneficio)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|boolean'
        ]);

        $beneficio->update($request->all());

        return redirect()->route('beneficios.index')
            ->with('success', 'Beneficio actualizado correctamente.');
    }

    public function destroy(Beneficio $beneficio)
    {
        $beneficio->delete();
        return redirect()->route('beneficios.index')
            ->with('success', 'Beneficio eliminado correctamente.');
    }

    // Asignar beneficios a un afiliado
    public function asignarForm($afiliado)
    {
        $afiliado = Afiliado::with('beneficio')->findOrFail($afiliado);
        $beneficios = Beneficio::all();

        return view('beneficios.asignar', compact('afiliado','beneficios'));
    }


    public function asignar(Request $request, Afiliado $afiliado)
    {
        $request->validate([
            'beneficios' => 'array'
        ]);

        $afiliado->beneficio()->sync($request->beneficios ?? []);

        return redirect()->route('afiliados.show', $afiliado)
            ->with('success', 'Beneficios actualizados correctamente.');
    }
}
