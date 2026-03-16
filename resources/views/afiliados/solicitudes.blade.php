@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Solicitudes Pendientes</h2>

    @if(session('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('mensaje') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <a href="{{ route('afiliados.create') }}" class="btn btn-primary mb-3">Nueva Solicitud</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Número Afiliado</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Empresa</th>
                <th>Estado</th>
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

                    @if($afiliado->estado_solicitud == 'pendiente')
                        <span class="badge bg-warning text-dark">Pendiente</span>

                    @elseif($afiliado->estado_solicitud == 'aprobada')
                        <span class="badge bg-success">Aprobada</span>

                    @elseif($afiliado->estado_solicitud == 'rechazada')
                        <span class="badge bg-danger">Rechazada</span>
                    @endif

                </td>

                <td>

                    <!-- Ver solicitud -->
                    <a href="{{ route('afiliados.show', $afiliado->id) }}"
                       class="btn btn-info btn-sm">
                       Ver
                    </a>

                    <!-- Editar solicitud -->
                    <a href="{{ route('afiliados.edit', $afiliado->id) }}"
                       class="btn btn-warning btn-sm">
                       Editar
                    </a>

                    <!-- Eliminar -->
                    <form action="{{ route('afiliados.destroy', $afiliado->id) }}"
                          method="POST"
                          class="d-inline">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm"
                        onclick="return confirm('¿Eliminar solicitud?')">
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
