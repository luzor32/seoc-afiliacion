<?php

namespace App\Http\Controllers;

use App\Models\Afiliado;
use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Models\PagoCuota;
use App\Models\CargaFamiliar;
use App\Models\Beneficio;



class AfiliadoController extends Controller
{
    // Mostrar todos los afiliados activos
    public function index()
    {
        $afiliados = Afiliado::with('empresa')
            ->where('estado_afiliado', 'activo')
            ->get();

        return view('afiliados.index', compact('afiliados'));
    }



    public function show($id)
    {
        $afiliado = Afiliado::with([
            'empresa',
            'cargasFamiliares',
            'pagoCuota',
            'beneficio'
        ])->findOrFail($id);

        return view('afiliados.show', compact('afiliado'));
    }




    // Mostrar formulario para nueva solicitud
    public function create()
    {
        $empresas = Empresa::all();
        return view('afiliados.create', compact('empresas'));
    }

    // Guardar nueva solicitud
    public function store(Request $request)
    {
        $data = $request->validate([
            'numero_afiliado' => 'required|unique:afiliados,numero_afiliado',
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'dni' => 'required|unique:afiliados,dni',
            'cuil' => 'nullable|string|max:20',
            'nacionalidad' => 'nullable|string|max:50',
            'fecha_nacimiento' => 'nullable|date',
            'provincia' => 'nullable|string|max:50',
            'localidad' => 'nullable|string|max:50',
            'calle' => 'nullable|string|max:100',
            'numero' => 'nullable|string|max:20',
            'codigo_postal' => 'nullable|string|max:10',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'empresa_id' => 'required|exists:empresas,id',
            'puesto' => 'nullable|string|max:50',
            'categoria_laboral' => 'nullable|string|max:50',
            'seccion' => 'nullable|string|max:50',
            'tipo_contrato' => 'nullable|string|max:50',
            'jornada_laboral' => 'nullable|string|max:50',
            'fecha_afiliacion' => 'nullable|date',
            'seccional' => 'nullable|string|max:50',
            'delegacion_sindical' => 'nullable|string|max:50',
            'foto_dni_frente' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'foto_dni_dorso' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'foto_recibo_sueldo' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'foto_constancia_laboral' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            'observaciones' => 'nullable|string',
        ]);

        // Todas las solicitudes empiezan pendientes
        $data['estado_solicitud'] = 'pendiente';
        $data['estado_afiliado'] = 'inactivo';

        Afiliado::create($data);

        return redirect()->route('afiliados.solicitudes')
            ->with('mensaje', 'Solicitud enviada correctamente');
    }

    // Listar solicitudes pendientes
    public function solicitudes()
    {
        $solicitudes = Afiliado::with('empresa')
            ->where('estado_solicitud', 'pendiente')
            ->get();

        return view('afiliados.solicitudes', compact('solicitudes'));
    }

    // Aprobar solicitud
    public function aprobar($id)
    {
        $afiliado = Afiliado::findOrFail($id);
        $afiliado->estado_solicitud = 'aprobada';
        $afiliado->estado_afiliado = 'activo';
        $afiliado->fecha_afiliacion = now();
        $afiliado->save();

        return redirect()->back()->with('mensaje', 'Solicitud aprobada y afiliado activo');
    }

    // Editar afiliado activo
    public function edit($id)
    {
        $afiliado = Afiliado::with('empresa', 'cargasFamiliares', 'pagocuota')->findOrFail($id);
        $empresas = Empresa::all();

        return view('afiliados.edit', compact('afiliado', 'empresas'));
    }

    // Actualizar afiliado activo
    public function update(Request $request, $id)
    {
        $afiliado = Afiliado::findOrFail($id);

        $data = $request->validate([
            'numero_afiliado' => 'required|unique:afiliados,numero_afiliado,' . $afiliado->id,
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'dni' => 'required|unique:afiliados,dni,' . $afiliado->id,
            'cuil' => 'nullable|string|max:20',
            'nacionalidad' => 'nullable|string|max:50',
            'fecha_nacimiento' => 'nullable|date',
            'provincia' => 'nullable|string|max:50',
            'localidad' => 'nullable|string|max:50',
            'calle' => 'nullable|string|max:100',
            'numero' => 'nullable|string|max:20',
            'codigo_postal' => 'nullable|string|max:10',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'empresa_id' => 'required|exists:empresas,id',
            'puesto' => 'nullable|string|max:50',
            'categoria_laboral' => 'nullable|string|max:50',
            'seccion' => 'nullable|string|max:50',
            'tipo_contrato' => 'nullable|string|max:50',
            'jornada_laboral' => 'nullable|string|max:50',
            'fecha_afiliacion' => 'nullable|date',
            'seccional' => 'nullable|string|max:50',
            'delegacion_sindical' => 'nullable|string|max:50',
            'foto_dni_frente' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'foto_dni_dorso' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'foto_recibo_sueldo' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'foto_constancia_laboral' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            'observaciones' => 'nullable|string',
        ]);

        $afiliado->update($data);

        return redirect()->route('afiliados.index')
            ->with('mensaje', 'Afiliado actualizado correctamente');
    }

    // Eliminar afiliado o solicitud
    public function destroy($id)
    {
        $afiliado = Afiliado::findOrFail($id);
        $afiliado->delete();

        return redirect()->back()->with('mensaje', 'Registro eliminado correctamente');
    }
}
