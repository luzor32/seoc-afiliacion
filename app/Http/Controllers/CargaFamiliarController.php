<?php

namespace App\Http\Controllers;

use App\Models\Afiliado;
use App\Models\CargaFamiliar;
use Illuminate\Http\Request;

class CargaFamiliarController extends Controller
{
    public function index($afiliado_id)
    {
        $afiliado = Afiliado::findOrFail($afiliado_id);
        $cargas = $afiliado->cargasFamiliares;

        return view('cargas.index', compact('afiliado', 'cargas'));
    }

    public function create($afiliado_id)
    {
        $afiliado = Afiliado::findOrFail($afiliado_id);

        // Validar que el afiliado esté activo y aprobado
        if ($afiliado->estado_afiliado != 'activo' || $afiliado->estado_solicitud != 'aprobada') {
            return redirect()->back()->with('error', 'No se pueden agregar cargas familiares para este afiliado.');
        }

        $parentescos = CargaFamiliar::parentescos();
        return view('cargas.create', compact('afiliado', 'parentescos'));
    }

    public function store(Request $request, $afiliado_id)
    {
        $afiliado = Afiliado::findOrFail($afiliado_id);

        if ($afiliado->estado_afiliado != 'activo' || $afiliado->estado_solicitud != 'aprobada') {
            return redirect()->back()->with('error', 'No se pueden agregar cargas familiares para este afiliado.');
        }

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|string|max:20',
            'parentesco' => 'required|in:Cónyuge,Hijo,Hijastro',
            'fecha_nacimiento' => 'nullable|date',
        ]);

        $data = $validated;
        $data['afiliado_id'] = $afiliado_id;

        // Guardar archivos según parentesco
        if ($request->parentesco == 'Hijo') {
            $data['foto_partida_nacimiento'] = $request->hasFile('foto_partida_nacimiento') ? $request->file('foto_partida_nacimiento')->store('cargas') : null;
            $data['constancia_escolaridad'] = $request->hasFile('constancia_escolaridad') ? $request->file('constancia_escolaridad')->store('cargas') : null;
            $data['certificado_discapacidad'] = $request->hasFile('certificado_discapacidad') ? $request->file('certificado_discapacidad')->store('cargas') : null;
        }

        if ($request->parentesco == 'Cónyuge') {
            $data['acta_matrimonio_convivencia'] = $request->hasFile('foto_acta_matrimonio')
                ? $request->file('foto_acta_matrimonio')->store('cargas', 'public')
                : null;
        }


        CargaFamiliar::create($data);

        return redirect()->route('cargas.index', $afiliado_id)
            ->with('success', 'Carga familiar agregada correctamente.');
    }

    public function edit($afiliado_id, $id)
    {
        $afiliado = Afiliado::findOrFail($afiliado_id);

        if ($afiliado->estado_afiliado != 'activo' || $afiliado->estado_solicitud != 'aprobada') {
            return redirect()->back()->with('error', 'No se pueden editar cargas familiares de este afiliado.');
        }

        $carga = CargaFamiliar::findOrFail($id);
        $parentescos = CargaFamiliar::parentescos();

        return view('cargas.edit', compact('afiliado', 'carga', 'parentescos'));
    }

    public function update(Request $request, $afiliado_id, $id)
    {
        $afiliado = Afiliado::findOrFail($afiliado_id);

        if ($afiliado->estado_afiliado != 'activo' || $afiliado->estado_solicitud != 'aprobada') {
            return redirect()->back()->with('error', 'No se pueden editar cargas familiares de este afiliado.');
        }

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|string|max:20',
            'parentesco' => 'required|in:Cónyuge,Hijo,Hijastro',
            'fecha_nacimiento' => 'nullable|date',
        ]);

        $carga = CargaFamiliar::findOrFail($id);

        // Archivos según parentesco
        if ($request->parentesco == 'Hijo') {
            if ($request->hasFile('foto_partida_nacimiento')) {
                $carga->foto_partida_nacimiento = $request->file('foto_partida_nacimiento')->store('cargas');
            }
            if ($request->hasFile('constancia_escolaridad')) {
                $carga->constancia_escolaridad = $request->file('constancia_escolaridad')->store('cargas');
            }
            if ($request->hasFile('certificado_discapacidad')) {
                $carga->certificado_discapacidad = $request->file('certificado_discapacidad')->store('cargas');
            }
        }

        if ($request->parentesco == 'Cónyuge') {
            if ($request->hasFile('foto_acta_matrimonio')) {
                $carga->acta_matrimonio_convivencia = $request->file('foto_acta_matrimonio')->store('cargas');
            }
        }

        // Actualizar campos básicos
        $carga->update($validated);

        return redirect()->route('cargas.index', $afiliado_id)
            ->with('success', 'Carga familiar actualizada correctamente.');
    }

    public function destroy($afiliado_id, $id)
    {
        $afiliado = Afiliado::findOrFail($afiliado_id);

        if ($afiliado->estado_afiliado != 'activo' || $afiliado->estado_solicitud != 'aprobada') {
            return redirect()->back()->with('error', 'No se pueden eliminar cargas familiares de este afiliado.');
        }

        $carga = CargaFamiliar::findOrFail($id);
        $carga->delete();

        return redirect()->route('cargas.index', $afiliado_id)
            ->with('success', 'Carga familiar eliminada correctamente.');
    }

    public function show($afiliado_id, $id)
    {
        $afiliado = Afiliado::findOrFail($afiliado_id);
        $carga = CargaFamiliar::findOrFail($id);

        return view('cargas.show', compact('afiliado', 'carga'));
    }
}
