@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Cargas familiares de {{ $afiliado->nombre }} {{ $afiliado->apellido }}</h3>

        <!-- Botón agregar carga (solo si el afiliado está activo y aprobado) -->
        @if ($afiliado->estado_afiliado == 'activo' && $afiliado->estado_solicitud == 'aprobada')
            <a href="{{ route('cargas.create', $afiliado->id) }}" class="btn btn-primary mb-3">Agregar carga</a>
        @endif

        <!-- Mensajes flash -->
        

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        <!-- Tabla de cargas -->
        <table class="table-bordered table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Parentesco</th>
                    <th>Documentos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cargas as $c)
                    <tr>
                        <td>{{ $c->nombre }}</td>
                        <td>{{ $c->apellido }}</td>
                        <td>{{ $c->parentesco }}</td>
                        <td>
                            @if ($c->parentesco == 'Hijo')
                                @if ($c->foto_partida_nacimiento)
                                    Partida ✔
                                @endif
                                @if ($c->constancia_escolaridad)
                                    Escolaridad ✔
                                @endif
                                @if ($c->certificado_discapacidad)
                                    Discapacidad ✔
                                @endif
                            @elseif($c->parentesco == 'Cónyuge')
                                @if ($c->foto_acta_matrimonio)
                                    Acta ✔
                                @endif
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('cargas.edit', [$afiliado->id, $c->id]) }}"
                                class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('cargas.destroy', [$afiliado->id, $c->id]) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Eliminar carga familiar?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('afiliados.show', $afiliado->id) }}" class="btn btn-secondary mt-3">Volver</a>
    </div>
@endsection
