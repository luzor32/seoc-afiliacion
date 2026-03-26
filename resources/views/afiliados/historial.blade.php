@extends('layouts.app')

@section('content')
<div class="container">

    {{-- TITULO --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">
            📋 Historial de {{ $afiliado->nombre }} {{ $afiliado->apellido }}
        </h3>

        <a href="{{ route('afiliados.show', ['afiliado' => $afiliado->id, 'origen' => 'afiliado']) }}"
           class="btn btn-outline-secondary btn-lg card border-0 shadow-lg">
            ← Volver
        </a>
    </div>

    {{-- CARD IGUAL AL INDEX --}}
    <div class="card border-0 shadow-lg">

        <div class="card-header bg-light">
            <strong>📊 Historial de estados</strong>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                {{-- TABLA IGUAL AL INDEX --}}
                <table class="table-hover table align-middle">

                    <thead class="bg-danger text-center text-white">
                        <tr>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Estado</th>
                            <th>Observación</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($historial as $item)
                            <tr class="text-center">

                                <td>{{ $item->created_at->format('d/m/Y') }}</td>

                                <td>{{ $item->created_at->format('H:i') }}</td>

                                {{-- ESTADO (MISMO ESTILO QUE INDEX) --}}
                                <td>
                                    @if ($item->estado == 'activo')
                                        <span class="badge bg-success">Activo</span>

                                    @elseif ($item->estado == 'suspendido')
                                        <span class="badge bg-danger">Suspendido</span>

                                    @elseif ($item->estado == 'baja')
                                        <span class="badge bg-dark">Baja</span>

                                    @elseif ($item->estado == 'reactivado')
                                        <span class="badge bg-primary">Reactivado</span>
                                    @endif
                                </td>

                                <td class="text-start">
                                    {{ $item->observacion }}
                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="4" class="text-muted text-center">
                                    No hay historial registrado
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