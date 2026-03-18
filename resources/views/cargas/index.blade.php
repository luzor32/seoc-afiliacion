@extends('layouts.app')

@section('content')
    <div class="container">

        {{-- ===================== TITULO ===================== --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">
                👨‍👩‍👧‍👦 Cargas familiares de {{ $afiliado->nombre }} {{ $afiliado->apellido }}
            </h3>

            {{-- BOTON AGREGAR --}}
            @if ($afiliado->estado_afiliado == 'activo' && $afiliado->estado_solicitud == 'aprobada')
                <a href="{{ route('cargas.create', $afiliado->id) }}" class="btn btn-primary btn-lg">
                    ➕ Agregar carga
                </a>
            @endif
        </div>

        {{-- ===================== ERRORES ===================== --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- ===================== CARD ===================== --}}
        <div class="card border-0 shadow-sm">

            <div class="card-header bg-light">
                <strong>📋 Listado de cargas familiares</strong>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table-hover table text-center align-middle" style="table-layout: fixed;">

                        <thead class="bg-danger text-center text-white">
                            <tr>
                                <th style="width:18%">Nombre</th>
                                <th style="width:18%">Apellido</th>
                                <th style="width:15%">Parentesco</th>
                                <th style="width:15%">DNI</th>
                                
                                <th style="width:16%">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($cargas as $c)
                                <tr>

                                    <td>{{ $c->nombre }}</td>
                                    <td>{{ $c->apellido }}</td>
                                    <td>{{ $c->parentesco }}</td>

                                    {{-- DNI --}}
                                    <td style="white-space: nowrap;">
                                        {{ $c->dni ?? '-' }}
                                    </td>



                                    {{-- ACCIONES --}}
                                    <td>
                                        <div class="d-flex justify-content-center flex-nowrap gap-2">
                                            {{-- VER --}}
                                            <a href="{{ route('cargas.show', [$afiliado->id, $c->id]) }}"
                                                class="btn btn-outline-info btn-sm" title="Ver">
                                                👁️
                                            </a>

                                            {{-- EDITAR --}}
                                            <a href="{{ route('cargas.edit', [$afiliado->id, $c->id]) }}"
                                                class="btn btn-outline-warning btn-sm" title="Editar">
                                                ✏️
                                            </a>

                                            {{-- ELIMINAR --}}
                                            <form action="{{ route('cargas.destroy', [$afiliado->id, $c->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-outline-danger btn-sm"
                                                    onclick="return confirm('¿Eliminar carga familiar?')" title="Eliminar">
                                                    🗑
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>

                            @empty
                                <tr>
                                    <td colspan="6" class="text-muted text-center">
                                        No hay cargas familiares registradas
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>
        </div>

        {{-- ===================== VOLVER ===================== --}}
        <div class="mt-3 text-end">
            <a href="{{ route('afiliados.edit', $afiliado->id) }}" class="btn btn-secondary btn-lg">
                ↩ Volver
            </a>
        </div>

    </div>
@endsection
