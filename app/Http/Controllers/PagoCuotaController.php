<?php

namespace App\Http\Controllers;

use App\Models\Afiliado;
use App\Models\PagoCuota;
use Illuminate\Http\Request;

class PagoCuotaController extends Controller
{
    // Listado de pagos por afiliado
    public function index($afiliado_id)
    {
        $afiliado = Afiliado::findOrFail($afiliado_id);
        $pagos = $afiliado->pagoCuota()->orderBy('fecha_pago', 'desc')->get();

        return view('pagos_cuotas.index', compact('afiliado', 'pagos'));
    }

    // Formulario de registro de pago
    public function create($afiliado_id)
    {
        $afiliado = Afiliado::findOrFail($afiliado_id);
        return view('pagos_cuotas.create', compact('afiliado'));
    }

    // Guardar pago
    public function store(Request $request, $afiliado_id)
    {
        $request->validate([
            'fecha_pago' => 'required|date',
            'monto' => 'required|numeric|min:0',
            'periodo' => 'required|string',
            'metodo_pago' => 'nullable|string',
        ]);

        $afiliado = Afiliado::findOrFail($afiliado_id);

        $afiliado->pagoCuota()->create($request->all());

        return redirect()->route('pagos_cuotas.index', $afiliado_id)
            ->with('success', 'Pago registrado correctamente.');
    }

    // Editar pago
    public function edit($afiliado_id, $id)
    {
        $afiliado = Afiliado::findOrFail($afiliado_id);
        $pago = PagoCuota::findOrFail($id);

        return view('pagos_cuotas.edit', compact('afiliado', 'pago'));
    }

    // Actualizar pago
    public function update(Request $request, $afiliado_id, $id)
    {
        $request->validate([
            'fecha_pago' => 'required|date',
            'monto' => 'required|numeric|min:0',
            'periodo' => 'required|string',
            'metodo_pago' => 'nullable|string',
        ]);

        $pago = PagoCuota::findOrFail($id);
        $pago->update($request->all());

        return redirect()->route('pagos_cuotas.index', $afiliado_id)
            ->with('success', 'Pago actualizado correctamente.');
    }

    // Eliminar pago
    public function destroy($afiliado_id, $id)
    {
        $pago = PagoCuota::findOrFail($id);
        $pago->delete();

        return redirect()->route('pagos_cuotas.index', $afiliado_id)
            ->with('success', 'Pago eliminado correctamente.');
    }
}
