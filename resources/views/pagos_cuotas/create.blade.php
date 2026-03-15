@extends('layouts.app')

@section('content')
<h2>{{ isset($pago) ? 'Editar Pago' : 'Registrar Pago' }} de {{ $afiliado->nombre }} {{ $afiliado->apellido }}</h2>

<form method="POST" action="{{ isset($pago) ? route('pagos_cuotas.update', [$afiliado->id, $pago->id]) : route('pagos_cuotas.store', $afiliado->id) }}">
    @csrf
    @if(isset($pago)) @method('PUT') @endif

    <div class="mb-3">
        <label>Fecha de Pago</label>
        <input type="date" name="fecha_pago" class="form-control" value="{{ old('fecha_pago', $pago->fecha_pago ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label>Monto</label>
        <input type="number" step="0.01" name="monto" class="form-control" value="{{ old('monto', $pago->monto ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label>Periodo (ej: 03/2026)</label>
        <input type="text" name="periodo" class="form-control" value="{{ old('periodo', $pago->periodo ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label>Método de Pago</label>
        <select name="metodo_pago" class="form-control">
            @php $metodos = ['Efectivo','Tarjeta','Transferencia'] @endphp
            @foreach($metodos as $metodo)
                <option value="{{ $metodo }}" {{ (old('metodo_pago', $pago->metodo_pago ?? '') == $metodo) ? 'selected' : '' }}>{{ $metodo }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">{{ isset($pago) ? 'Actualizar' : 'Registrar' }}</button>
    <a href="{{ route('pagos_cuotas.index', $afiliado->id) }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
