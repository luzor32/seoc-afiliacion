@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Empresas</h1>

    <a href="{{ route('empresas.create') }}" class="btn btn-primary mb-3">Nueva Empresa</a>

    @if(session('mensaje'))
        <div class="alert alert-success">{{ session('mensaje') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>CUIT</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Actividad</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($empresas as $empresa)
            <tr>
                <td>{{ $empresa->nombre }}</td>
                <td>{{ $empresa->cuit }}</td>
                <td>{{ $empresa->telefono }}</td>
                <td>{{ $empresa->email }}</td>
                <td>{{ $empresa->actividad }}</td>
                <td>{{ ucfirst($empresa->estado) }}</td>
                <td>
                    <a href="{{ route('empresas.edit', $empresa->id) }}" class="btn btn-warning btn-sm">Editar</a>

                    <form action="{{ route('empresas.destroy', $empresa->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('¿Seguro querés eliminar esta empresa?')">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
