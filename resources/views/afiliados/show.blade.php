@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card border-0 shadow-lg">

            {{-- ===================== TITULO ===================== --}}
            <div class="mb-4">
                <h3 class="fw-bold">
                    📋
                    @if (request('origen') == 'solicitud')
                        Ficha de Solicitud
                    @else
                        Ficha de Afiliado
                    @endif
                </h3>
            </div>
            {{-- ===================== DATOS PERSONALES ===================== --}}
            <div class="card mb-4 border-0 shadow-sm">

                <div class="card-header bg-light">
                    <strong>👤 Datos Personales</strong>
                </div>

                <div class="card-body">

                    <div class="row mb-3">

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nombre</label>
                            <div class="form-control bg-light">
                                {{ $afiliado->nombre }} {{ $afiliado->apellido }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">DNI</label>
                            <div class="form-control bg-light">{{ $afiliado->dni }}</div>
                        </div>

                    </div>

                    <div class="row mb-3">



                        <div class="col-md-4">
                            <label class="form-label fw-bold">CUIL</label>
                            <div class="form-control bg-light">{{ $afiliado->cuil }}</div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Nacionalidad</label>
                            <div class="form-control bg-light">
                                {{ $afiliado->nacionalidad ?? 'No registrada' }}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Fecha Nacimiento</label>
                            <div class="form-control bg-light">
                                {{ $afiliado->fecha_nacimiento ?? 'No registrada' }}
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Email</label>
                            <div class="form-control bg-light">
                                {{ $afiliado->email ?? '-' }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Teléfono</label>
                            <div class="form-control bg-light">
                                {{ $afiliado->telefono ?? '-' }}
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            {{-- ===================== DOMICILIO ===================== --}}
            <div class="card mb-4 border-0 shadow-sm">

                <div class="card-header bg-light">
                    <strong>🏠 Domicilio</strong>
                </div>

                <div class="card-body">

                    <div class="row mb-3">

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Provincia</label>
                            <div class="form-control bg-light">{{ $afiliado->provincia ?? '-' }}</div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Localidad</label>
                            <div class="form-control bg-light">{{ $afiliado->localidad ?? '-' }}</div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Código Postal</label>
                            <div class="form-control bg-light">{{ $afiliado->codigo_postal ?? '-' }}</div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-8">
                            <label class="form-label fw-bold">Calle</label>
                            <div class="form-control bg-light">{{ $afiliado->calle ?? '-' }}</div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Número</label>
                            <div class="form-control bg-light">{{ $afiliado->numero ?? '-' }}</div>
                        </div>

                    </div>

                </div>
            </div>

            {{-- ===================== DATOS LABORALES ===================== --}}
            <div class="card mb-4 border-0 shadow-sm">

                <div class="card-header bg-light">
                    <strong>🏢 Datos Laborales</strong>
                </div>

                <div class="card-body">

                    <div class="row mb-3">

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Empresa</label>
                            <div class="form-control bg-light">
                                {{ $afiliado->empresa->nombre ?? 'Sin empresa' }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Puesto</label>
                            <div class="form-control bg-light">
                                {{ $afiliado->puesto ?? '-' }}
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tipo de Contrato</label>
                            <div class="form-control bg-light">
                                {{ $afiliado->tipo_contrato ?? '-' }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Jornada</label>
                            <div class="form-control bg-light">
                                {{ $afiliado->jornada_laboral ?? '-' }}
                            </div>
                        </div>

                    </div>



                </div>
            </div>

            {{-- ===================== DATOS SINDICALES ===================== --}}
            <div class="card mb-4 border-0 shadow-sm">

                <div class="card-header bg-light">
                    <strong>🏛 Datos Sindicales</strong>
                </div>

                <div class="card-body">

                    <div class="row">


                        <div class="col-md-4">
                            <label class="form-label fw-bold">Número de Afiliado</label>
                            <div class="form-control bg-light">
                                {{ $afiliado->numero_afiliado }}
                            </div>
                        </div>



                        <div class="col-md-4">
                            <label class="form-label fw-bold">Delegación</label>
                            <div class="form-control bg-light">
                                {{ $afiliado->delegacion_sindical ?? 'No registrada' }}
                            </div>
                        </div>

                    </div>

                    @if ($origen != 'solicitud')
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Fecha de Afiliación</label>
                            <div class="form-control">
                                {{ $afiliado->fecha_afiliacion?->format('d/m/Y H:i') ?? '-' }}
                            </div>
                        </div>
                    @endif

                    {{-- ===================== ESTADOS ===================== --}}

                    @if ($origen == 'solicitud')
                        <form id="formAccion" method="POST">
                            @csrf

                            <div class="row align-items-end">

                                {{-- ESTADO ACTUAL --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Estado de Solicitud</label>
                                    <div
                                        class="form-control @if ($afiliado->estado_solicitud == 'pendiente') bg-warning text-dark
                                        @elseif($afiliado->estado_solicitud == 'rechazada') bg-danger text-white
                                                @elseif($afiliado->estado_solicitud == 'aprobada') bg-success text-white @endif">
                                        {{ ucfirst($afiliado->estado_solicitud) }}
                                    </div>
                                </div>

                                {{-- CAMBIAR ESTADO --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Cambiar estado</label>

                                    <select name="accion" class="form-select" onchange="cambiarAccion(this)"
                                        @if($afiliado->estado_solicitud == 'rechazada') disabled @endif>

                                        <option value="">Seleccione</option>
                                        <option value="aprobar">Aprobar</option>
                                        <option value="rechazar">Rechazar</option>
                                    </select>
                                </div>

                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Observaciones</label>

                                @if($afiliado->estado_solicitud == 'rechazada')
                                    <div class="form-control bg-light text-danger">
                                        {{ $afiliado->observaciones }}
                                    </div>
                                @else
                                    <textarea name="observaciones" class="form-control"></textarea>
                                @endif
                            </div>

                            @if($afiliado->estado_solicitud != 'rechazada')
                                <button type="submit" class="btn btn-secondary" onclick="return validarAccion()">
                                    Guardar
                                </button>
                            @endif

                        </form>
                    @endif


                    {{-- ===================== MODO AFILIADO ===================== --}}
                    @if ($origen == 'afiliado')
                        <div class="mb-3">
                            <label class="form-label fw-bold">Estado del Afiliado</label>
                            <div class="form-control @if ($afiliado->estado_afiliado == 'activo') bg-info text-white
                            @elseif($afiliado->estado_afiliado == 'suspendido') bg-danger text-white @endif">
                                {{ ucfirst($afiliado->estado_afiliado) }}
                            </div>
                        </div>

                        {{-- suspender --}}
                        @if ($afiliado->estado_afiliado == 'activo')
                            <form method="POST" action="{{ route('afiliados.suspender', $afiliado->id) }}">
                                @csrf

                                <div class="card-header bg-light">
                                    <strong>📝 Observaciones</strong>

                                    <textarea name="observaciones" class="form-control" required></textarea>
                                </div>

                                <button class="btn btn-warning">suspender</button>
                            </form>
                        @endif

                        {{-- ACTIVAR --}}
                        @if ($afiliado->estado_afiliado == 'suspendido')
                            <form method="POST" action="{{ route('afiliados.activar', $afiliado->id) }}">
                                @csrf
                                <button class="btn btn-success">Activar</button>
                            </form>
                        @endif
                    @endif




                </div>
            </div>

            @if ($afiliado->estado_afiliado == 'activo')

                {{-- ===================== CARGAS FAMILIARES ===================== --}}
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-light">
                        <strong>👨‍👩‍👧‍👦 Cargas Familiares</strong>
                    </div>

                    <div class="card-body">

                        @if ($afiliado->cargasFamiliares->count())
                            <div class="table-responsive">
                                <table class="table-bordered table-hover table align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>DNI</th>
                                            <th>Parentesco</th>
                                            <th>Fecha Nacimiento</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($afiliado->cargasFamiliares as $carga)
                                            <tr>
                                                <td>{{ $carga->nombre }}</td>
                                                <td>{{ $carga->apellido }}</td>
                                                <td>{{ $carga->dni }}</td>
                                                <td>{{ $carga->parentesco }}</td>
                                                <td>{{ $carga->fecha_nacimiento ?? '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-muted">Sin cargas familiares</div>
                        @endif

                    </div>
                </div>


                {{-- ===================== BENEFICIOS ===================== --}}
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-light">
                        <strong>🎁 Beneficios</strong>
                    </div>

                    <div class="card-body">
                        @if ($afiliado->beneficio->count())
                            <ul class="list-group">
                                @foreach ($afiliado->beneficio as $beneficio)
                                    <li class="list-group-item">
                                        {{ $beneficio->nombre }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="text-muted">Sin beneficios asignados</div>
                        @endif
                    </div>
                </div>

            @endif


            <div class="card mb-4 border-0 shadow-sm">

                <div class="card-header bg-light">
                    <strong>📸 Documentación</strong>
                </div>

                <div class="card-body">

                    <div class="row text-center">

                        {{-- DNI FRENTE --}}
                        <div class="col-md-3">
                            <label class="form-label fw-bold">DNI Frente</label><br>

                            @if ($afiliado->foto_dni_frente)
                                <img src="{{ asset('storage/' . $afiliado->foto_dni_frente) }}" class="img-thumbnail mt-2"
                                    style="max-width:150px; cursor:pointer;" data-bs-toggle="modal"
                                    data-bs-target="#modalImagen"
                                    onclick="mostrarImagen('{{ asset('storage/' . $afiliado->foto_dni_frente) }}')">
                            @else
                                <div class="text-muted">Sin imagen</div>
                            @endif
                        </div>

                        {{-- DNI DORSO --}}
                        <div class="col-md-3">
                            <label class="form-label fw-bold">DNI Dorso</label><br>

                            @if ($afiliado->foto_dni_dorso)
                                <img src="{{ asset('storage/' . $afiliado->foto_dni_dorso) }}" class="img-thumbnail mt-2"
                                    style="max-width:150px; cursor:pointer;" data-bs-toggle="modal"
                                    data-bs-target="#modalImagen"
                                    onclick="mostrarImagen('{{ asset('storage/' . $afiliado->foto_dni_dorso) }}')">
                            @else
                                <div class="text-muted">Sin imagen</div>
                            @endif
                        </div>

                        {{-- RECIBO SUELDO --}}
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Recibo de Sueldo</label><br>

                            @if ($afiliado->foto_recibo_sueldo)
                                <img src="{{ asset('storage/' . $afiliado->foto_recibo_sueldo) }}" class="img-thumbnail mt-2"
                                    style="max-width:150px; cursor:pointer;" data-bs-toggle="modal"
                                    data-bs-target="#modalImagen"
                                    onclick="mostrarImagen('{{ asset('storage/' . $afiliado->foto_recibo_sueldo) }}')">
                            @else
                                <div class="text-muted">Sin imagen</div>
                            @endif
                        </div>

                        {{-- CONSTANCIA LABORAL --}}
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Constancia Laboral</label><br>

                            @if ($afiliado->foto_constancia_laboral)
                                <img src="{{ asset('storage/' . $afiliado->foto_constancia_laboral) }}"
                                    class="img-thumbnail mt-2" style="max-width:150px; cursor:pointer;" data-bs-toggle="modal"
                                    data-bs-target="#modalImagen"
                                    onclick="mostrarImagen('{{ asset('storage/' . $afiliado->foto_constancia_laboral) }}')">
                            @else
                                <div class="text-muted">Sin imagen</div>
                            @endif
                        </div>

                    </div>

                </div>

            </div>

            {{-- ===================== MODAL ===================== --}}
            <div class="modal fade" id="modalImagen" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content bg-dark border-0">

                        <div class="modal-body text-center">
                            <img id="imagenGrande" src="" class="img-fluid rounded">
                        </div>

                        <div class="modal-footer justify-content-center border-0">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                Cerrar
                            </button>
                        </div>

                    </div>
                </div>
            </div>

            {{-- ===================== SCRIPT ===================== --}}
            <script>
                function mostrarImagen(ruta) {
                    document.getElementById('imagenGrande').src = ruta;
                }
            </script>

            {{-- ===================== BOTONES ===================== --}}
            <div class="text-end">

                @if (in_array($afiliado->estado_solicitud, ['pendiente', 'rechazada']))
                    <a href="{{ route('afiliados.solicitudes') }}" class="btn btn-secondary btn-lg">
                        ↩ Volver a Solicitudes
                    </a>
                @else
                    <a href="{{ route('afiliados.index') }}" class="btn btn-secondary btn-lg">
                        ↩ Volver a Afiliados
                    </a>
                @endif

            </div>
        </div>

    </div>
@endsection

<script>
    function cambiarAccion(select) {
        let form = document.getElementById('formAccion'); // ✅ CORREGIDO
        let id = {{ $afiliado->id }};

        if (select.value === 'aprobar') {
            form.action = '/afiliados/' + id + '/aprobar';
        }
        else if (select.value === 'rechazar') {
            form.action = '/afiliados/' + id + '/rechazar';
        }
    }
    function validarAccion() {
        let select = document.querySelector('select[name="accion"]');

        if (!select.value) {
            alert('Seleccione una acción');
            return false;
        }
        return true;
    }
</script>