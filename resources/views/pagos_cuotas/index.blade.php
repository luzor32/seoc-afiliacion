@extends('layouts.app')

@section('content')
<h2>Pagos de {{ $afiliado->nombre }} {{ $afiliado->apellido }}</h2>

<a href="{{ route('pagos_cuotas.create', $afiliado->id) }}" class="btn btn-primary mb-3">Registrar Pago</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Monto</th>
            <th>Periodo</th>
            <th>Método de Pago</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pagos as $pago)
        <tr>
            <td>{{ $pago->fecha_pago }}</td>
            <td>{{ $pago->monto }}</td>
            <td>{{ $pago->periodo }}</td>
            <td>{{ $pago->metodo_pago }}</td>
            <td>
                <a href="{{ route('pagos_cuotas.edit', [$afiliado->id,$pago->id]) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('pagos_cuotas.destroy', [$afiliado->id,$pago->id]) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que desea eliminar este pago?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
