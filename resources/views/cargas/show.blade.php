@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Detalle Carga Familiar: {{ $carga->nombre }} {{ $carga->apellido }}</h3>

    <!-- Mensajes flash -->
    

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    <!-- Detalle de la carga -->
    <p><strong>Parentesco:</strong> {{ $carga->parentesco }}</p>
    <p><strong>Fecha de nacimiento:</strong> {{ $carga->fecha_nacimiento ?? '-' }}</p>

    @if($carga->parentesco == 'Hijo')
        @if($carga->foto_partida_nacimiento)
            <p>Partida de nacimiento: <a href="{{ Storage::url($carga->foto_partida_nacimiento) }}" target="_blank">Ver</a></p>
        @endif
        @if($carga->constancia_escolaridad)
            <p>Constancia escolaridad: <a href="{{ Storage::url($carga->constancia_escolaridad) }}" target="_blank">Ver</a></p>
        @endif
        @if($carga->certificado_discapacidad)
            <p>Certificado discapacidad: <a href="{{ Storage::url($carga->certificado_discapacidad) }}" target="_blank">Ver</a></p>
        @endif
    @elseif($carga->parentesco == 'Cónyuge')
        @if($carga->foto_acta_matrimonio)
            <p>Acta matrimonio: <a href="{{ Storage::url($carga->foto_acta_matrimonio) }}" target="_blank">Ver</a></p>
        @endif
    @endif

    <!-- Botones de acción -->
    <div class="mt-3">
        <a href="{{ route('cargas.index', $afiliado->id) }}" class="btn btn-secondary">Volver</a>

        @if($afiliado->estado_afiliado == 'activo' && $afiliado->estado_solicitud == 'aprobada')
            <a href="{{ route('cargas.edit', [$afiliado->id, $carga->id]) }}" class="btn btn-warning">Editar</a>

            <form action="{{ route('cargas.destroy', [$afiliado->id, $carga->id]) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" onclick="return confirm('¿Eliminar carga familiar?')">Eliminar</button>
            </form>
        @endif
    </div>
</div>
@endsection
