<?php

namespace App\Http\Controllers;

use App\Models\Afiliado;
use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Models\HistorialAfiliado;

class AfiliadoController extends Controller
{
  

    public function index(Request $request)
    {
        $query = Afiliado::with('empresa')
            ->whereIn('estado_afiliado', ['activo', 'suspendido']); // 👈 FIX

        // 🔍 BUSCADOR
        if ($request->filled('buscar')) {
            $query->where(function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->buscar . '%')
                ->orWhere('apellido', 'like', '%' . $request->buscar . '%')
                ->orWhere('numero_afiliado', 'like', '%' . $request->buscar . '%')
                ->orWhere('dni', 'like', '%' . $request->buscar . '%');
            });
        }

        $afiliados = $query
            ->orderBy('fecha_afiliacion', 'desc') // ✅ ORDEN CORRECTO
            ->paginate(2)
            ->withQueryString();

        return view('afiliados.index', compact('afiliados'));
    }


    // VER AFILIADO
    public function show(Request $request, $id)
    {
        $afiliado = Afiliado::with([
            'empresa',
            'cargasFamiliares',
            'pagoCuota',
            'beneficio',
            'historial'
        ])->findOrFail($id);

        $origen = $request->get('origen'); // 👈 ACA ESTA LA CLAVE

        return view('afiliados.show', compact('afiliado', 'origen'));
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

        // PERSONALES
        'numero_afiliado' => 'required|unique:afiliados,numero_afiliado',
        'nombre' => 'required|string|max:100',
        'apellido' => 'required|string|max:100',
        'dni' => 'required|unique:afiliados,dni',
        'cuil' => 'nullable|string|max:20',
        'nacionalidad' => 'nullable|string|max:50',
        'fecha_nacimiento' => 'nullable|date',

        // DOMICILIO
        'provincia' => 'nullable|string|max:100',
        'localidad' => 'nullable|string|max:100',
        'calle' => 'nullable|string|max:150',
        'numero' => 'nullable|string|max:10',
        'codigo_postal' => 'nullable|string|max:10',

        // CONTACTO
        'telefono' => 'nullable|string|max:20',
        'email' => 'nullable|email|max:100',

        // LABORAL
        'empresa_id' => 'required|exists:empresas,id',
        'puesto' => 'nullable|string|max:100',
        'categoria_laboral' => 'nullable|string|max:100',
        'seccion' => 'nullable|string|max:100',
        'tipo_contrato' => 'nullable|string|max:100',
        'jornada_laboral' => 'nullable|string|max:100',

        // SINDICAL
        
        
        'delegacion_sindical' => 'nullable|string|max:100',

        // OBSERVACIONES
        'observaciones' => 'nullable|string',

        // DOCUMENTOS
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
        $data['estado_afiliado'] = null; // 👈 clave


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

        // PERSONALES
        'numero_afiliado' => 'required|unique:afiliados,numero_afiliado,' . $afiliado->id,
        'nombre' => 'required|string|max:100',
        'apellido' => 'required|string|max:100',
        'dni' => 'required|unique:afiliados,dni,' . $afiliado->id,
        'cuil' => 'nullable|string|max:20',
        'nacionalidad' => 'nullable|string|max:50',
        'fecha_nacimiento' => 'nullable|date',

        // DOMICILIO
        'provincia' => 'nullable|string|max:100',
        'localidad' => 'nullable|string|max:100',
        'calle' => 'nullable|string|max:150',
        'numero' => 'nullable|string|max:10',
        'codigo_postal' => 'nullable|string|max:10',

        // CONTACTO
        'telefono' => 'nullable|string|max:20',
        'email' => 'nullable|email|max:100',

        // LABORAL
        'empresa_id' => 'required|exists:empresas,id',
        'puesto' => 'nullable|string|max:100',
        
        
        'tipo_contrato' => 'nullable|string|max:100',
        'jornada_laboral' => 'nullable|string|max:100',

        // SINDICAL
        
        'seccional' => 'nullable|string|max:100',
        'delegacion_sindical' => 'nullable|string|max:100',

        // OBSERVACIONES
        'observaciones' => 'nullable|string',

        // DOCUMENTOS
        'foto_dni_frente' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        'foto_dni_dorso' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        'foto_recibo_sueldo' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        'foto_constancia_laboral' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
    ]);

    // 🔥 MUY IMPORTANTE: evitar que se sobrescriba la fecha
    unset($data['fecha_afiliacion']);


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
        $afiliado->fecha_afiliacion = now();

        $afiliado->save();
        // 🔥 HISTORIAL
        $afiliado->historial()->create([
            'estado' => 'alta',
            'observacion' => 'Afiliado aprobado y dado de alta'
        ]);

        return redirect()->route('afiliados.solicitudes')
            ->with('mensaje','Afiliado aprobado correctamente');
    }

    public function rechazar(Request $request, $id)
    {
        $afiliado = Afiliado::findOrFail($id);

        // 🚫 BLOQUEO
        if ($afiliado->estado_solicitud === 'rechazada') {
            return redirect()->back()->with('error', 'La solicitud ya fue rechazada');
        }

        $request->validate([
            'observaciones' => 'required|string'
        ]);

        $afiliado->estado_solicitud = 'rechazada';
        $afiliado->estado_afiliado = null;
        $afiliado->observaciones = $request->observaciones;

        $afiliado->save();

        return redirect()->route('afiliados.solicitudes')
            ->with('mensaje','Solicitud rechazada');
    }

    public function activar($id)
    {
        $afiliado = Afiliado::findOrFail($id);

        $afiliado->estado_afiliado = 'activo';

        // 🔥 SI VENÍA DE BAJA → limpiar fecha_baja
        if ($afiliado->fecha_baja) {
            $afiliado->fecha_baja = null;
        }
        $afiliado->save();

        // 🔥 HISTORIAL
        $afiliado->historial()->create([
            'estado' => 'reactivado',
            'observacion' => 'Afiliado reactivado'
        ]);

        return back()->with('mensaje','Afiliado activado');
    }
    public function suspender(Request $request, $id)
    {
        $request->validate([
            'observaciones' => 'required|string'
        ]);

        $afiliado = Afiliado::findOrFail($id);

        $afiliado->estado_afiliado = 'suspendido';
        $afiliado->observaciones = $request->observaciones;

        $afiliado->save();

        // 🔥 HISTORIAL
        $afiliado->historial()->create([
            'estado' => 'suspendido',
            'observacion' => $request->observaciones
        ]);

        return back()->with('mensaje','Afiliado suspendido');
    }



    public function solicitudes(Request $request)
    {
        $query = Afiliado::with('empresa')
            ->whereIn('estado_solicitud', ['pendiente', 'rechazada']);

        // 🔍 BUSCADOR
        if ($request->filled('buscar')) {
            $query->where(function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->buscar . '%')
                ->orWhere('apellido', 'like', '%' . $request->buscar . '%')
                ->orWhere('numero_afiliado', 'like', '%' . $request->buscar . '%')
                ->orWhere('dni', 'like', '%' . $request->buscar . '%');

            });
        }

        // 🎯 FILTRO POR ESTADO DE SOLICITUD (opcional)
        if ($request->filled('estado_solicitud')) {
            $query->where('estado_solicitud', $request->estado_solicitud);
        }

        // 📄 PAGINACIÓN
        // ⬇️ ORDEN + PAGINACIÓN
        $solicitudes = $query
            ->latest() // 👈 LOS MÁS NUEVOS PRIMERO
            ->paginate(2)
            ->withQueryString();

        return view('afiliados.solicitudes', compact('solicitudes'));
    }

    public function baja(Request $request, $id)
    {
        $request->validate([
            'motivo_baja' => 'required|string'
        ]);

        $afiliado = Afiliado::findOrFail($id);

        $afiliado->estado_afiliado = 'baja';
        $afiliado->fecha_baja = now();
        $afiliado->motivo_baja = $request->motivo_baja;
        $afiliado->save();

        // 🔥 HISTORIAL
        $afiliado->historial()->create([
            'estado' => 'baja',
            'observacion' => $request->motivo_baja
        ]);

        return back()->with('mensaje','Afiliado dado de baja');
    }

    public function altaDirecta($id)
    {
        $afiliado = Afiliado::findOrFail($id);

        $afiliado->estado_afiliado = 'activo';
        $afiliado->fecha_afiliacion = now();
        $afiliado->save();

        // 🔥 HISTORIAL
        $afiliado->historial()->create([
            'estado' => 'alta_directa',
            'observacion' => 'Reingreso sin solicitud'
        ]);

        return back()->with('mensaje','Afiliado dado de alta nuevamente');
    }

    
    

}
