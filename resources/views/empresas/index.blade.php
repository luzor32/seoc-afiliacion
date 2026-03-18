@extends('layouts.app')

@section('content')
<div class="container">

    {{-- ===================== TITULO ===================== --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">🏢 Gestión de Empresas</h3>

        <a href="{{ route('empresas.create') }}" class="btn btn-primary btn-lg">
            ➕ Nueva Empresa
        </a>
    </div>

    {{-- ===================== MENSAJE ===================== --}}
    @if(session('mensaje'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('mensaje') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ===================== CARD ===================== --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-light">
            <strong>📋 Empresas registradas</strong>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead class="bg-danger text-white text-center">
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

                        @forelse($empresas as $empresa)
                            <tr class="text-center">

                                <td>{{ $empresa->nombre }}</td>
                                <td>{{ $empresa->cuit }}</td>
                                <td>{{ $empresa->telefono ?? '-' }}</td>
                                <td>{{ $empresa->email ?? '-' }}</td>
                                <td>{{ $empresa->actividad ?? '-' }}</td>

                                {{-- ESTADO --}}
                                <td>
                                    @if($empresa->estado == 'activa')
                                        <span class="badge bg-success">Activa</span>
                                    @else
                                        <span class="badge bg-secondary">Inactiva</span>
                                    @endif
                                </td>

                                {{-- ACCIONES --}}
                                <td>
                                    <div class="d-flex justify-content-center gap-2">

                                        {{-- EDITAR --}}
                                        <a href="{{ route('empresas.edit', $empresa->id) }}"
                                           class="btn btn-outline-warning btn-sm"
                                           title="Editar">
                                            ✏️
                                        </a>

                                        {{-- ELIMINAR --}}
                                        <form action="{{ route('empresas.destroy', $empresa->id) }}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('¿Seguro querés eliminar esta empresa?')"
                                                title="Eliminar">
                                                🗑
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    No hay empresas registradas
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
