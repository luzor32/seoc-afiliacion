@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Afiliado: {{ $afiliado->nombre }} {{ $afiliado->apellido }}</h3>

    
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Botón Agregar carga: solo si afiliado activo y solicitud aprobada -->
    @if($afiliado->estado_afiliado == 'activo' && $afiliado->estado_solicitud == 'aprobada')
        <a href="{{ route('cargas.create', $afiliado->id) }}" class="btn btn-primary">
            Agregar carga familiar
        </a>

    @else
        <div class="alert alert-warning mb-3">
            No se pueden agregar cargas familiares. El afiliado no está activo o su solicitud no fue aprobada.
        </div>
    @endif

    <!-- Listado de cargas familiares -->
    <h4>Cargas Familiares</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Parentesco</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($afiliado->cargasFamiliares as $carga)
                <tr>
                    <td>{{ $carga->nombre }}</td>
                    <td>{{ $carga->apellido }}</td>
                    <td>{{ $carga->parentesco }}</td>
                    <td>
                        <a href="{{ route('cargas.show', [$afiliado->id, $carga->id]) }}" class="btn btn-sm btn-info">
                            Ver
                        </a>

                        <a href="{{ route('cargas.edit', [$afiliado->id, $carga->id]) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('cargas.destroy', [$afiliado->id, $carga->id]) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar esta carga?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Beneficios asignados -->
    <h4>Beneficios Asignados</h4>
    @if($afiliado->beneficios && $afiliado->beneficios->isNotEmpty())
        <ul>
        @foreach($afiliado->beneficios as $beneficio)
            <li>{{ $beneficio->nombre }}</li>
        @endforeach
        </ul>
    @else
        <div class="alert alert-info">No se han asignado beneficios a este afiliado.</div>
    @endif
    <a href="{{ route('afiliados.beneficios.asignar', $afiliado) }}" class="btn btn-primary mb-3">Asignar / Modificar beneficios</a>

    <!-- Pagos de cuotas -->
    <div class="mt-5">
        <h4>Pagos de Cuotas</h4>

        <!-- Botones para registrar y ver pagos -->
        <a href="{{ route('pagos_cuotas.create', $afiliado->id) }}" class="btn btn-success mb-3">Registrar Pago</a>
        <a href="{{ route('pagos_cuotas.index', $afiliado->id) }}" class="btn btn-info mb-3">Ver Todos los Pagos</a>

        @if($afiliado->pagoCuota && $afiliado->pagoCuota->isNotEmpty())

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Monto</th>
                    <th>Periodo</th>
                    <th>Método de Pago</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($afiliado->pagoCuota as $pago)
                <tr>
                    <td>{{ $pago->fecha_pago }}</td>
                    <td>{{ $pago->monto }}</td>
                    <td>{{ $pago->periodo }}</td>
                    <td>{{ $pago->metodo_pago }}</td>
                    <td>
                        <a href="{{ route('pagos_cuotas.edit', [$afiliado->id, $pago->id]) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('pagos_cuotas.destroy', [$afiliado->id, $pago->id]) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este pago?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <div class="alert alert-info">No hay pagos registrados para este afiliado.</div>
        @endif
    </div>

    <a href="{{ route('afiliados.index', $afiliado->id) }}" class="btn btn-secondary mt-3">Volver</a>

</div>
@endsection
