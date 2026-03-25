@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="GET" class="row mb-3">


            {{-- ===================== TITULO ===================== --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold">📋 Solicitudes de Afiliación</h3>

                <a href="{{ route('afiliados.create') }}" class="btn btn-outline-secondary btn-lg card border-0 shadow-lg ">
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

            

            {{-- ===================== BUSCADOR EN LINEA ===================== --}}
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

                {{-- ESTADO --}}
                <div class="col-md-3">
                    <select name="estado_solicitud" class="form-select">
                        <option value="">Todas</option>
                        <option value="pendiente" {{ request('estado_solicitud') == 'pendiente' ? 'selected' : '' }}>
                            Pendiente
                        </option>
                        <option value="rechazada" {{ request('estado_solicitud') == 'rechazada' ? 'selected' : '' }}>
                            Rechazada
                        </option>
                    </select>
                </div>

                {{-- BOTONES --}}
                <div class="col-md-4 d-flex gap-2">
                    <button class="btn btn-primary w-100">
                         Buscar
                    </button>

                    <a href="{{ route('afiliados.solicitudes') }}" class="btn btn-outline-secondary w-100">
                        Limpiar
                    </a>
                </div>

            </div>
        </form>

    </div>
</div>



            {{-- ===================== CARD ===================== --}}
            <div class="card border-0 shadow-lg">


                <div class="card-header bg-light">
                    <strong>📝 Solicitudes registradas</strong>
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

                                @forelse($solicitudes as $afiliado)
                                    <tr class="text-center">

                                        <td>{{ $afiliado->numero_afiliado }}</td>

                                        <td>
                                            {{ $afiliado->nombre }} {{ $afiliado->apellido }}
                                        </td>

                                        <td>{{ $afiliado->dni }}</td>

                                        <td>{{ $afiliado->empresa->nombre ?? 'Sin empresa' }}</td>

                                        {{-- ESTADO --}}
                                        <td>
                                            @if ($afiliado->estado_solicitud == 'pendiente')
                                                <span class="badge bg-warning text-dark">Pendiente</span>
                                            @elseif($afiliado->estado_solicitud == 'aprobada')
                                                <span class="badge bg-success">Aprobada</span>
                                            @elseif($afiliado->estado_solicitud == 'rechazada')
                                                <span class="badge bg-danger">Rechazada</span>
                                            @endif
                                        </td>

                                        {{-- ACCIONES --}}
                                        <td>

                                            <div class="d-flex justify-content-center gap-2">

                                                {{-- VER --}}
                                                <a href="{{ route('afiliados.show', ['afiliado' => $afiliado->id, 'origen' => 'solicitud']) }}"
                                                    class="btn btn-outline-secondary btn-sm" title="Ver">
                                                    👁
                                                </a>

                                                {{-- EDITAR --}}


                                                <a href="{{ route('afiliados.edit', ['afiliado' => $afiliado->id, 'origen' => 'solicitud']) }}"
                                                    class="btn btn-outline-warning btn-sm" title="Editar">
                                                    ✏️
                                                </a>

                                                {{-- ELIMINAR --}}
                                                <form action="{{ route('afiliados.destroy', $afiliado->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-outline-danger btn-sm"
                                                        onclick="return confirm('¿Eliminar solicitud?')" title="Eliminar">
                                                        🗑
                                                    </button>
                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="6" class="text-muted text-center">
                                            No hay solicitudes registradas
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                {{ $solicitudes->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>

    </div>
@endsection