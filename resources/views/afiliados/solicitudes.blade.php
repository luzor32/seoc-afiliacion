@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Solicitudes Pendientes</h2>

    @if(session('mensaje'))
        <div class="alert alert-success">{{ session('mensaje') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Número Afiliado</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Empresa</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($solicitudes as $afiliado)
                <tr>
                    <td>{{ $afiliado->numero_afiliado }}</td>
                    <td>{{ $afiliado->nombre }}</td>
                    <td>{{ $afiliado->apellido }}</td>
                    <td>{{ $afiliado->dni }}</td>
                    <td>{{ $afiliado->empresa->nombre ?? '' }}</td>
                    <td>
                        <form action="{{ route('afiliados.aprobar', $afiliado->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-success btn-sm" type="submit">Aprobar</button>
                        </form>
                        <form action="{{ route('afiliados.destroy', $afiliado->id) }}" method="POST" class="mt-1">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
