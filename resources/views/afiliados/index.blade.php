@extends('layouts.app')

@section('content')
    <div class="container">

        {{-- ===================== TITULO ===================== --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">📋 Listado de Afiliados</h3>

            <a href="{{ route('afiliados.create') }}" class="btn btn-outline-secondary btn-lg card border-0 shadow-lg ">
                    ➕ Nueva Solicitud
                </a>
        </div>

        {{-- ===================== BUSCADOR INDEX EN LINEA ===================== --}}
<div class="card border-0 shadow-lg mb-4">
    <div class="card-body">

        <form method="GET">
            <div class="row g-2 align-items-center">

                {{-- BUSCAR --}}
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text">🔍</span>
                        <input type="text" name="buscar" class="form-control"
                            placeholder="Nombre, apellido, DNI o N° afiliado"
                            value="{{ request('buscar') }}">
                    </div>
                </div>

                {{-- ESTADO AFILIADO --}}
                <div class="col-md-3">
                    <select name="estado_afiliado" class="form-select">
                        <option value="">Todos</option>
                        <option value="activo" {{ request('estado_afiliado') == 'activo' ? 'selected' : '' }}>
                            Activo
                        </option>
                        <option value="suspendido" {{ request('estado_afiliado') == 'suspendido' ? 'selected' : '' }}>
                            Suspendido
                        </option>
                        <option value="baja" {{ request('estado_afiliado') == 'baja' ? 'selected' : '' }}>
                            Baja
                        </option>
                    </select>
                </div>

                {{-- BOTONES --}}
                <div class="col-md-4 d-flex gap-2">
                    <button class="btn btn-primary w-100">
                         Buscar
                    </button>

                    <a href="{{ route('afiliados.index') }}" class="btn btn-outline-secondary w-100">
                        Limpiar
                    </a>
                </div>

            </div>
        </form>

    </div>
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
                                <th>Fecha de Afiliación</th>
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

                                    <td>{{ $afiliado->fecha_afiliacion->format('d/m/Y') ?? 'Sin fecha' }}</td>

                                    {{-- ESTADO --}}
                                    <td>
                                        @if ($afiliado->estado_afiliado == 'activo')
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-danger">suspendido</span>
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
                    <div class="d-flex justify-content-center">
                        {{ $afiliados->links() }}
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection