@extends('layouts.app')

@section('content')
<div class="container">

<h3>Ficha del Afiliado</h3>

{{-- DATOS DEL AFILIADO --}}
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        {{ $afiliado->nombre }} {{ $afiliado->apellido }}
    </div>

    <div class="card-body">
        <div class="row">

            <div class="col-md-6">
                <p><strong>Número Afiliado:</strong> {{ $afiliado->numero_afiliado }}</p>
                <p><strong>DNI:</strong> {{ $afiliado->dni }}</p>
                <p><strong>CUIL:</strong> {{ $afiliado->cuil }}</p>
                <p><strong>Email:</strong> {{ $afiliado->email }}</p>
                <p><strong>Teléfono:</strong> {{ $afiliado->telefono }}</p>
            </div>

            <div class="col-md-6">
                <p><strong>Empresa:</strong> {{ $afiliado->empresa->nombre ?? 'Sin empresa' }}</p>
                <p><strong>Dirección:</strong> {{ $afiliado->calle }} {{ $afiliado->numero }}</p>
                <p><strong>Localidad:</strong> {{ $afiliado->localidad }}</p>

                {{-- ESTADO SOLICITUD --}}
                @if(in_array($afiliado->estado_solicitud,['pendiente','rechazada']))
                    <p>
                        <strong>Estado Solicitud:</strong>
                        @if($afiliado->estado_solicitud == 'pendiente')
                            <span class="badge bg-warning text-dark">Pendiente</span>
                        @else
                            <span class="badge bg-danger">Rechazada</span>
                        @endif
                    </p>
                @endif

                {{-- ESTADO AFILIADO --}}
                {{-- Solo mostrar si no es solicitud pendiente o rechazada --}}
                @if(!in_array($afiliado->estado_solicitud,['pendiente','rechazada']))
                    <p>
                        <strong>Estado Afiliado:</strong>
                        @if($afiliado->estado_afiliado == 'activo')
                            <span class="badge bg-success">Activo</span>
                        @else
                            <span class="badge bg-secondary">Inactivo</span>
                        @endif
                    </p>
                @endif
            </div>

        </div>
    </div>
</div>

{{-- ACCIONES DE SOLICITUD --}}
@if($afiliado->estado_solicitud == 'pendiente')
    <div class="dropdown mb-4">
        <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
            Acciones de Solicitud
        </button>

        <ul class="dropdown-menu">
            <li>
                <form action="{{ route('afiliados.aprobar',$afiliado->id) }}" method="POST">
                    @csrf
                    <button class="dropdown-item text-success">Aprobar Solicitud</button>
                </form>
            </li>
            <li>
                <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#modalRechazar">
                    Rechazar Solicitud
                </button>
            </li>
        </ul>
    </div>
@endif

{{-- ESTADO DEL AFILIADO --}}
{{-- Solo mostrar si no es solicitud pendiente o rechazada --}}
@if(!in_array($afiliado->estado_solicitud,['pendiente','rechazada']))
    <div class="dropdown mb-4">
        <button class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown">
            Estado del Afiliado
        </button>

        <ul class="dropdown-menu">
            <li>
                <form action="{{ route('afiliados.activar',$afiliado->id) }}" method="POST">
                    @csrf
                    <button class="dropdown-item text-success">Activar Afiliado</button>
                </form>
            </li>
            <li>
                <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#modalInactivar">
                    Inactivar Afiliado
                </button>
            </li>
        </ul>
    </div>
@endif

{{-- DOCUMENTACION --}}
<h4 class="mb-3">Documentación del Afiliado</h4>

<div class="row">

    {{-- DNI Frente --}}
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-danger text-white text-center fw-bold">
                DNI Frente
            </div>
            <div class="card-body text-center">
                @if($afiliado->foto_dni_frente)
                    <img src="{{ asset('storage/'.$afiliado->foto_dni_frente) }}"
                        class="img-fluid img-thumbnail"
                        style="max-height:250px; cursor:pointer"
                        data-bs-toggle="modal"
                        data-bs-target="#modalFrente">
                @else
                    <p class="text-muted">No cargado</p>
                @endif
            </div>
        </div>
    </div>

    {{-- DNI Dorso --}}
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-secondary text-white text-center fw-bold">
                DNI Dorso
            </div>
            <div class="card-body text-center">
                @if($afiliado->foto_dni_dorso)
                    <img src="{{ asset('storage/'.$afiliado->foto_dni_dorso) }}"
                        class="img-fluid img-thumbnail"
                        style="max-height:250px; cursor:pointer"
                        data-bs-toggle="modal"
                        data-bs-target="#modalDorso">
                @else
                    <p class="text-muted">No cargado</p>
                @endif
            </div>
        </div>
    </div>

    {{-- Constancia laboral --}}
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white text-center fw-bold">
                Constancia Laboral
            </div>
            <div class="card-body text-center">
                @if($afiliado->foto_constancia_laboral)
                    <img src="{{ asset('storage/'.$afiliado->foto_constancia_laboral) }}"
                        class="img-fluid img-thumbnail"
                        style="max-height:250px; cursor:pointer"
                        data-bs-toggle="modal"
                        data-bs-target="#modalConstancia">
                @else
                    <p class="text-muted">No cargado</p>
                @endif
            </div>
        </div>
    </div>

    {{-- Recibo de sueldo --}}
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white text-center fw-bold">
                Recibo de Sueldo
            </div>
            <div class="card-body text-center">
                @if($afiliado->foto_recibo_sueldo)
                    <img src="{{ asset('storage/'.$afiliado->foto_recibo_sueldo) }}"
                        class="img-fluid img-thumbnail"
                        style="max-height:250px; cursor:pointer"
                        data-bs-toggle="modal"
                        data-bs-target="#modalRecibo">
                @else
                    <p class="text-muted">No cargado</p>
                @endif
            </div>
        </div>
    </div>

</div>

{{-- CARGAS FAMILIARES, BENEFICIOS Y PAGOS solo si no es solicitud --}}
@if(!in_array($afiliado->estado_solicitud,['pendiente','rechazada']))

    {{-- CARGAS FAMILIARES --}}
    <h4>Cargas Familiares</h4>
    <a href="{{ route('cargas.create',$afiliado->id) }}" class="btn btn-primary mb-3">Agregar Carga Familiar</a>

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
            @forelse($afiliado->cargasFamiliares as $carga)
                <tr>
                    <td>{{ $carga->nombre }}</td>
                    <td>{{ $carga->apellido }}</td>
                    <td>{{ $carga->parentesco }}</td>
                    <td>
                        <a href="{{ route('cargas.show',[$afiliado->id,$carga->id]) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('cargas.edit',[$afiliado->id,$carga->id]) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('cargas.destroy',[$afiliado->id,$carga->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar carga?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center">No hay cargas familiares</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- BENEFICIOS --}}
    <h4 class="mt-4">Beneficios Asignados</h4>
    @if(isset($afiliado->beneficio) && $afiliado->beneficio->count())
        <ul>
            @foreach($afiliado->beneficio as $beneficio)
                <li>{{ $beneficio->nombre }}</li>
            @endforeach
        </ul>
    @else
        <div class="alert alert-info">No tiene beneficios asignados</div>
    @endif
    <a href="{{ route('afiliados.beneficios.asignar',$afiliado) }}" class="btn btn-primary mb-4">Asignar / Modificar Beneficios</a>

    {{-- PAGOS --}}
    <h4>Pagos de Cuotas</h4>
    <a href="{{ route('pagos_cuotas.create',$afiliado->id) }}" class="btn btn-success mb-3">Registrar Pago</a>
    <a href="{{ route('pagos_cuotas.index',$afiliado->id) }}" class="btn btn-info mb-3">Ver Todos los Pagos</a>

@endif

{{-- BOTON VOLVER --}}
@if(in_array($afiliado->estado_solicitud,['pendiente','rechazada']))
    <a href="{{ route('afiliados.solicitudes') }}" class="btn btn-secondary mt-3">Volver a Solicitudes</a>
@endif

@if(!in_array($afiliado->estado_solicitud,['pendiente','rechazada']))
    <a href="{{ route('afiliados.index') }}" class="btn btn-secondary mt-3">Volver a Afiliados</a>
@endif

</div>

{{-- MODALES --}}
{{-- RECHAZAR SOLICITUD --}}
<div class="modal fade" id="modalRechazar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rechazar Solicitud</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('afiliados.rechazar',$afiliado->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <label>Motivo del rechazo</label>
                    <textarea name="observaciones" class="form-control" rows="4" required></textarea>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-danger">Rechazar</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- INACTIVAR AFILIADO --}}
<div class="modal fade" id="modalInactivar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Inactivar Afiliado</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('afiliados.inactivar',$afiliado->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <label>Motivo de inactivación</label>
                    <textarea name="observaciones" class="form-control" rows="4" required></textarea>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-danger">Inactivar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection