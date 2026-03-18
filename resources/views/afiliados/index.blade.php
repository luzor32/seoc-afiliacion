@extends('layouts.app')

@section('content')
    <div class="container">

        {{-- ===================== TITULO ===================== --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">📋 Listado de Afiliados</h3>

            <a href="{{ route('afiliados.create') }}" class="btn btn-primary btn-lg">
                ➕ Nueva Solicitud
            </a>
        </div>

        {{-- MENSAJE --}}
        @if (session('mensaje'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('mensaje') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- ===================== CARD ===================== --}}
        
        <div class="card border-0 shadow-lg">
            <div class="card-header bg-light">
                <strong>👥 Afiliados registrados</strong>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table-hover table align-middle">

                        <thead class="bg-danger text-center text-white">
                            <tr>
                                <th>N° Afiliado</th>
                                <th>Afiliado</th>
                                <th>DNI</th>
                                <th>Empresa</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($afiliados as $afiliado)
                                <tr class="text-center">

                                    <td>{{ $afiliado->numero_afiliado }}</td>

                                    <td>
                                        {{ $afiliado->nombre }} {{ $afiliado->apellido }}
                                    </td>

                                    <td>{{ $afiliado->dni }}</td>

                                    <td>{{ $afiliado->empresa->nombre ?? 'Sin empresa' }}</td>

                                    {{-- ESTADO --}}
                                    <td>
                                        @if ($afiliado->estado_afiliado == 'activo')
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-secondary">Inactivo</span>
                                        @endif
                                    </td>

                                    {{-- ACCIONES --}}
                                    <td>

                                        <div class="d-flex justify-content-center gap-2">

                                            {{-- VER --}}
                                            <a href="{{ route('afiliados.show', ['afiliado' => $afiliado->id, 'origen' => 'afiliado']) }}"
                                                class="btn btn-outline-secondary btn-sm" title="Ver">
                                                👁
                                            </a>

                                            {{-- EDITAR --}}
                                            <a href="{{ route('afiliados.edit', ['afiliado' => $afiliado->id, 'origen' => 'afiliado']) }}"
                                                class="btn btn-outline-warning btn-sm">
                                                ✏️
                                            </a>


                                            {{-- ELIMINAR --}}
                                            <form action="{{ route('afiliados.destroy', $afiliado->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-outline-danger btn-sm"
                                                    onclick="return confirm('¿Seguro que deseas eliminar este afiliado?')"
                                                    title="Eliminar">
                                                    🗑
                                                </button>
                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty
                                <tr>
                                    <td colspan="6" class="text-muted text-center">
                                        No hay afiliados registrados
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </div>
@endsection
