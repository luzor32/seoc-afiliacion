@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Beneficios</h1>

    

    <a href="{{ route('beneficios.create') }}" class="btn btn-primary mb-3">Crear Beneficio</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @forelse($beneficios as $beneficio)
            <tr>
                <td>{{ $beneficio->nombre }}</td>
                <td>{{ $beneficio->descripcion }}</td>
                <td>{{ $beneficio->estado ? 'Activo' : 'Inactivo' }}</td>
                <td>
                    <a href="{{ route('beneficios.edit', $beneficio) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('beneficios.destroy', $beneficio) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este beneficio?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">No hay beneficios cargados.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
