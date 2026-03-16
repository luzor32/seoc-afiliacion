<?php

namespace App\Http\Controllers;

use App\Models\Afiliado;
use App\Models\Empresa;
use Illuminate\Http\Request;

class AfiliadoController extends Controller
{

    // LISTA DE AFILIADOS ACTIVOS
    public function index()
    {
        $afiliados = Afiliado::with('empresa')->get(); // Trae todos los afiliados

        return view('afiliados.index', compact('afiliados'));
    }


    // VER AFILIADO
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


    // FORMULARIO NUEVA SOLICITUD
    public function create()
    {
        $empresas = Empresa::all();

        return view('afiliados.create', compact('empresas'));
    }


    // GUARDAR SOLICITUD
    public function store(Request $request)
    {
        $data = $request->validate([
            'numero_afiliado' => 'required|unique:afiliados,numero_afiliado',
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'dni' => 'required|unique:afiliados,dni',
            'cuil' => 'nullable|string|max:20',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'empresa_id' => 'required|exists:empresas,id',

            'foto_dni_frente' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'foto_dni_dorso' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'foto_recibo_sueldo' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'foto_constancia_laboral' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ]);


        /*
        |--------------------------------------------------------------------------
        | GUARDAR DOCUMENTOS
        |--------------------------------------------------------------------------
        | Se guardan en storage/app/public/afiliados
        | Laravel devolverá algo como:
        | afiliados/archivo.jpg
        |
        */

        if ($request->hasFile('foto_dni_frente')) {
            $data['foto_dni_frente'] = $request->file('foto_dni_frente')
                ->store('afiliados', 'public');
        }

        if ($request->hasFile('foto_dni_dorso')) {
            $data['foto_dni_dorso'] = $request->file('foto_dni_dorso')
                ->store('afiliados', 'public');
        }

        if ($request->hasFile('foto_recibo_sueldo')) {
            $data['foto_recibo_sueldo'] = $request->file('foto_recibo_sueldo')
                ->store('afiliados', 'public');
        }

        if ($request->hasFile('foto_constancia_laboral')) {
            $data['foto_constancia_laboral'] = $request->file('foto_constancia_laboral')
                ->store('afiliados', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | ESTADO INICIAL DE LA SOLICITUD
        |--------------------------------------------------------------------------
        */

        $data['estado_solicitud'] = 'pendiente';
        $data['estado_afiliado'] = 'inactivo';


        /*
        |--------------------------------------------------------------------------
        | CREAR AFILIADO
        |--------------------------------------------------------------------------
        */

        Afiliado::create($data);


        /*
        |--------------------------------------------------------------------------
        | REDIRECCION
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('afiliados.solicitudes')
            ->with('mensaje', 'Solicitud enviada correctamente');
    }


    // LISTA DE SOLICITUDES
    public function solicitudes()
    {
        $solicitudes = Afiliado::with('empresa')
            ->where('estado_solicitud', 'pendiente')
            ->get();

        return view('afiliados.solicitudes', compact('solicitudes'));
    }


    // EDITAR SOLICITUD
    public function edit($id)
    {
        $afiliado = Afiliado::findOrFail($id);
        $empresas = Empresa::all();

        return view('afiliados.edit', compact('afiliado', 'empresas'));
    }


    // ACTUALIZAR SOLICITUD
    public function update(Request $request, $id)
    {
        $afiliado = Afiliado::findOrFail($id);

        $data = $request->validate([
            'numero_afiliado' => 'required|unique:afiliados,numero_afiliado,' . $afiliado->id,
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'dni' => 'required|unique:afiliados,dni,' . $afiliado->id,
            'cuil' => 'nullable|string|max:20',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'empresa_id' => 'required|exists:empresas,id',

            'foto_dni_frente' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'foto_dni_dorso' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'foto_recibo_sueldo' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'foto_constancia_laboral' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ]);


        // ACTUALIZAR IMÁGENES SI SE SUBEN NUEVAS
        if ($request->hasFile('foto_dni_frente')) {
            $data['foto_dni_frente'] = $request->file('foto_dni_frente')->store('afiliados', 'public');
        }

        if ($request->hasFile('foto_dni_dorso')) {
            $data['foto_dni_dorso'] = $request->file('foto_dni_dorso')->store('afiliados', 'public');
        }

        if ($request->hasFile('foto_recibo_sueldo')) {
            $data['foto_recibo_sueldo'] = $request->file('foto_recibo_sueldo')->store('afiliados', 'public');
        }

        if ($request->hasFile('foto_constancia_laboral')) {
            $data['foto_constancia_laboral'] = $request->file('foto_constancia_laboral')->store('afiliados', 'public');
        }

        $afiliado->update($data);

        return redirect()->route('afiliados.solicitudes')
            ->with('mensaje', 'Solicitud actualizada correctamente');
    }


    // ELIMINAR AFILIADO O SOLICITUD
    public function destroy($id)
    {
        $afiliado = Afiliado::findOrFail($id);
        $afiliado->delete();

        return redirect()->back()->with('mensaje', 'Registro eliminado correctamente');
    }

    // Aprobar solicitud
   

    public function aprobar($id)
    {
        $afiliado = Afiliado::findOrFail($id);

        $afiliado->estado_solicitud = 'aprobada';
        $afiliado->estado_afiliado = 'activo';

        $afiliado->save();

        return redirect()->route('afiliados.index')
            ->with('mensaje','Afiliado aprobado correctamente');
    }

    public function rechazar(Request $request, $id)
    {
        $request->validate([
            'observaciones' => 'required|string'
        ]);

        $afiliado = Afiliado::findOrFail($id);

        $afiliado->estado_solicitud = 'rechazada';
        $afiliado->observaciones = $request->observaciones;

        $afiliado->save();

        return redirect()->route('afiliados.solicitudes')
            ->with('mensaje','Solicitud rechazada');
    }

    public function activar($id)
    {
        $afiliado = Afiliado::findOrFail($id);

        $afiliado->estado_afiliado = 'activo';
        $afiliado->save();

        return back()->with('mensaje','Afiliado activado');
    }
    public function inactivar(Request $request, $id)
    {
        $request->validate([
            'observaciones' => 'required|string'
        ]);

        $afiliado = Afiliado::findOrFail($id);

        $afiliado->estado_afiliado = 'inactivo';
        $afiliado->observaciones = $request->observaciones;

        $afiliado->save();

        return back()->with('mensaje','Afiliado inactivado');
    }

}