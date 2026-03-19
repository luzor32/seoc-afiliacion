@extends('layouts.app')

@section('content')
<div class="container">

    {{-- ===================== TITULO ===================== --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">🎁 Gestión de Beneficios</h3>

        <a href="{{ route('beneficios.create') }}" class="btn btn-primary btn-lg">
            ➕ Crear Beneficio
        </a>
    </div>

    {{-- ===================== CARD ===================== --}}
    <div class="card border-0 shadow-lg">

        <div class="card-header bg-light">
            <strong>📋 Beneficios registrados</strong>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead class="bg-danger text-white text-center">
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($beneficios as $beneficio)
                            <tr class="text-center">

                                <td>{{ $beneficio->nombre }}</td>

                                <td>
                                    {{ $beneficio->descripcion ?? 'Sin descripción' }}
                                </td>

                                {{-- ESTADO --}}
                                <td>
                                    @if($beneficio->estado)
                                        <span class="badge bg-success">Activo</span>
                                    @else
                                        <span class="badge bg-secondary">Inactivo</span>
                                    @endif
                                </td>

                                {{-- ACCIONES --}}
                                <td>

                                    <div class="d-flex justify-content-center gap-2">

                                        {{-- EDITAR --}}
                                        <a href="{{ route('beneficios.edit', $beneficio) }}"
                                           class="btn btn-outline-warning btn-sm" title="Editar">
                                            ✏️
                                        </a>

                                        {{-- ELIMINAR --}}
                                        <form action="{{ route('beneficios.destroy', $beneficio) }}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('¿Eliminar este beneficio?')"
                                                title="Eliminar">
                                                🗑
                                            </button>
                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    No hay beneficios cargados
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
