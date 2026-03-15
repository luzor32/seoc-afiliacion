@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Afiliados Activos</h2>

        @if (session('mensaje'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('mensaje') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        <a href="{{ route('afiliados.create') }}" class="btn btn-primary mb-3">Nueva Solicitud</a>

        <div class="table-responsive">
            <table class="table-bordered table-hover table align-middle">
                <thead class="bg-danger text-white">
                    <tr>
                        <th>N° Afiliado</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>DNI</th>
                        <th>Empresa</th>
                        <th>Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($afiliados as $afiliado)
                        <tr>
                            <td>{{ $afiliado->numero_afiliado }}</td>
                            <td>{{ $afiliado->nombre }}</td>
                            <td>{{ $afiliado->apellido }}</td>
                            <td>{{ $afiliado->dni }}</td>
                            <td>{{ $afiliado->empresa->nombre ?? '' }}</td>
                            <td>{{ ucfirst($afiliado->estado_afiliado) }}</td>
                            <td class="text-center">
                                <a href="{{ route('afiliados.edit', $afiliado->id) }}" class="btn btn-warning btn-sm"
                                    title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="{{ route('afiliados.show', $afiliado->id) }}" class="btn btn-secondary btn-sm"
                                    title="Ver">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <form action="{{ route('afiliados.destroy', $afiliado->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" title="Eliminar"
                                        onclick="return confirm('¿Seguro que deseas eliminar este afiliado?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
