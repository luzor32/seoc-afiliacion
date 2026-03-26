<?php

namespace App\Http\Controllers;

use App\Models\Afiliado;
use App\Models\CargaFamiliar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

            // VALIDACIÓN DE ARCHIVOS (RECOMENDADO)
            'dni_frente' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'dni_dorso' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_partida_nacimiento' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'constancia_escolaridad' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'certificado_discapacidad' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_acta_matrimonio' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $validated;
        $data['afiliado_id'] = $afiliado_id;

        // ===================== DNI (SIEMPRE) =====================
        if ($request->hasFile('dni_frente')) {
            $data['foto_dni_frente'] = $request->file('dni_frente')->store('cargas/dni', 'public');
        }

        if ($request->hasFile('dni_dorso')) {
            $data['dni_dorso'] = $request->file('dni_dorso')->store('cargas/dni', 'public');
        }

       // NORMALIZAR
            $parentesco = trim(strtolower($request->parentesco));

            // ===================== HIJO / HIJASTRO =====================
            if (in_array($parentesco, ['hijo', 'hijastro'])) {

            if ($request->hasFile('foto_partida_nacimiento')) {
                $data['partida_nacimiento'] = $request->file('foto_partida_nacimiento')
                    ->store('cargas/partidas', 'public');
            }

            if ($request->hasFile('constancia_escolaridad')) {
                $data['constancia_escolaridad'] = $request->file('constancia_escolaridad')
                    ->store('cargas/escolaridad', 'public');
            }

            if ($request->hasFile('certificado_discapacidad')) {
                $data['certificado_discapacidad'] = $request->file('certificado_discapacidad')
                    ->store('cargas/discapacidad', 'public');
            }
        }

        // ===================== CONYUGE =====================
        if ($parentesco == 'cónyuge' || $parentesco == 'conyuge') {

            if ($request->hasFile('foto_acta_matrimonio')) {
                $data['foto_acta_matrimonio'] = $request->file('foto_acta_matrimonio')
                    ->store('cargas/matrimonio', 'public');
            }
        }

        // ===================== GUARDAR =====================
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

            // archivos
            'dni_frente' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'dni_dorso' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_partida_nacimiento' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'constancia_escolaridad' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'certificado_discapacidad' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_acta_matrimonio' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $carga = CargaFamiliar::findOrFail($id);

        $data = $validated;

       // ===================== DNI =====================
if ($request->hasFile('dni_frente')) {
    if ($carga->foto_dni_frente) {
        Storage::disk('public')->delete($carga->foto_dni_frente);
    }
    $data['foto_dni_frente'] = $request->file('dni_frente')->store('cargas/dni', 'public');
}

if ($request->hasFile('dni_dorso')) {
    if ($carga->foto_dni_dorso) {
        Storage::disk('public')->delete($carga->foto_dni_dorso);
    }
    $data['foto_dni_dorso'] = $request->file('dni_dorso')->store('cargas/dni', 'public');
}

// ===================== HIJO / HIJASTRO =====================
        $parentesco = trim(strtolower($request->parentesco));

        if (in_array($parentesco, ['hijo', 'hijastro'])) {

            if ($request->hasFile('foto_partida_nacimiento')) {
                if ($carga->partida_nacimiento) {
                    Storage::disk('public')->delete($carga->partida_nacimiento);
                }
                $data['partida_nacimiento'] = $request->file('foto_partida_nacimiento')
                    ->store('cargas/partidas', 'public');
            }

            if ($request->hasFile('constancia_escolaridad')) {
                if ($carga->constancia_escolaridad) {
                    Storage::disk('public')->delete($carga->constancia_escolaridad);
                }
                $data['constancia_escolaridad'] = $request->file('constancia_escolaridad')
                    ->store('cargas/escolaridad', 'public');
            }

            if ($request->hasFile('certificado_discapacidad')) {
                if ($carga->certificado_discapacidad) {
                    Storage::disk('public')->delete($carga->certificado_discapacidad);
                }
                $data['certificado_discapacidad'] = $request->file('certificado_discapacidad')
                    ->store('cargas/discapacidad', 'public');
            }
        }

        // ===================== CONYUGE =====================
        if ($parentesco == 'cónyuge' || $parentesco == 'conyuge') {

            if ($request->hasFile('foto_acta_matrimonio')) {
                if ($carga->foto_acta_matrimonio) {
                    Storage::disk('public')->delete($carga->foto_acta_matrimonio);
                }
                $data['foto_acta_matrimonio'] = $request->file('foto_acta_matrimonio')
                    ->store('cargas/matrimonio', 'public');
            }
        }

        // ===================== ACTUALIZAR =====================
        $carga->update($data);

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
