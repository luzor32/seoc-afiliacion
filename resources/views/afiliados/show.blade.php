@extends('layouts.app')

@section('content')
    <div class="container">

        {{-- ===================== TITULO ===================== --}}
        <div class="mb-4">
            <h3 class="fw-bold">📋 Ficha del Afiliado</h3>
            <p class="text-muted">Información completa de la solicitud</p>
        </div>

        {{-- ===================== DATOS PERSONALES ===================== --}}
        <div class="card mb-4 border-0 shadow-sm">

            <div class="card-header bg-danger text-white">
                <strong>👤 Datos Personales</strong>
            </div>

            <div class="card-body">

                <div class="row mb-3">

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Afiliado</label>
                        <div class="form-control bg-light">
                            {{ $afiliado->nombre }} {{ $afiliado->apellido }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Número de Afiliado</label>
                        <div class="form-control bg-light">
                            {{ $afiliado->numero_afiliado }}
                        </div>
                    </div>

                </div>

                <div class="row mb-3">

                    <div class="col-md-3">
                        <label class="form-label fw-bold">DNI</label>
                        <div class="form-control bg-light">{{ $afiliado->dni }}</div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-bold">CUIL</label>
                        <div class="form-control bg-light">{{ $afiliado->cuil }}</div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-bold">Nacionalidad</label>
                        <div class="form-control bg-light">
                            {{ $afiliado->nacionalidad ?? 'No registrada' }}
                        </div>
                    </div>

                    <div class="col-md-3">
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

                <div class="row mb-3">

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Categoría</label>
                        <div class="form-control bg-light">
                            {{ $afiliado->categoria_laboral ?? '-' }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Sección</label>
                        <div class="form-control bg-light">
                            {{ $afiliado->seccion ?? '-' }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Tipo de Contrato</label>
                        <div class="form-control bg-light">
                            {{ $afiliado->tipo_contrato ?? '-' }}
                        </div>
                    </div>

                </div>

                <div class="row">

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
                        <label class="form-label fw-bold">Fecha Afiliación</label>
                        <div class="form-control bg-light">
                            {{ $afiliado->fecha_afiliacion ?? 'No registrada' }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Seccional</label>
                        <div class="form-control bg-light">
                            {{ $afiliado->seccional ?? 'No registrada' }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Delegación</label>
                        <div class="form-control bg-light">
                            {{ $afiliado->delegacion_sindical ?? 'No registrada' }}
                        </div>
                    </div>

                </div>

            </div>
        </div>

        {{-- ===================== OBSERVACIONES ===================== --}}
        <div class="card mb-4 border-0 shadow-sm">

            <div class="card-header bg-light">
                <strong>📝 Observaciones</strong>
            </div>

            <div class="card-body">
                <div class="form-control bg-light" style="min-height:80px;">
                    {{ $afiliado->observaciones ?? 'Sin observaciones' }}
                </div>
            </div>

        </div>

        <div class="card mb-4 border-0 shadow-sm">

    <div class="card-header bg-light">
        <strong>📸 Documentación</strong>
    </div>

    <div class="card-body">

        <div class="row text-center">

            {{-- DNI FRENTE --}}
            <div class="col-md-3">
                <label class="form-label fw-bold">DNI Frente</label><br>

                @if($afiliado->foto_dni_frente)
                    <img src="{{ asset('storage/'.$afiliado->foto_dni_frente) }}"
                         class="img-thumbnail mt-2"
                         style="max-width:150px; cursor:pointer;"
                         data-bs-toggle="modal"
                         data-bs-target="#modalImagen"
                         onclick="mostrarImagen('{{ asset('storage/'.$afiliado->foto_dni_frente) }}')">
                @else
                    <div class="text-muted">Sin imagen</div>
                @endif
            </div>

            {{-- DNI DORSO --}}
            <div class="col-md-3">
                <label class="form-label fw-bold">DNI Dorso</label><br>

                @if($afiliado->foto_dni_dorso)
                    <img src="{{ asset('storage/'.$afiliado->foto_dni_dorso) }}"
                         class="img-thumbnail mt-2"
                         style="max-width:150px; cursor:pointer;"
                         data-bs-toggle="modal"
                         data-bs-target="#modalImagen"
                         onclick="mostrarImagen('{{ asset('storage/'.$afiliado->foto_dni_dorso) }}')">
                @else
                    <div class="text-muted">Sin imagen</div>
                @endif
            </div>

            {{-- RECIBO SUELDO --}}
            <div class="col-md-3">
                <label class="form-label fw-bold">Recibo de Sueldo</label><br>

                @if($afiliado->foto_recibo_sueldo)
                    <img src="{{ asset('storage/'.$afiliado->foto_recibo_sueldo) }}"
                         class="img-thumbnail mt-2"
                         style="max-width:150px; cursor:pointer;"
                         data-bs-toggle="modal"
                         data-bs-target="#modalImagen"
                         onclick="mostrarImagen('{{ asset('storage/'.$afiliado->foto_recibo_sueldo) }}')">
                @else
                    <div class="text-muted">Sin imagen</div>
                @endif
            </div>

            {{-- CONSTANCIA LABORAL --}}
            <div class="col-md-3">
                <label class="form-label fw-bold">Constancia Laboral</label><br>

                @if($afiliado->foto_constancia_laboral)
                    <img src="{{ asset('storage/'.$afiliado->foto_constancia_laboral) }}"
                         class="img-thumbnail mt-2"
                         style="max-width:150px; cursor:pointer;"
                         data-bs-toggle="modal"
                         data-bs-target="#modalImagen"
                         onclick="mostrarImagen('{{ asset('storage/'.$afiliado->foto_constancia_laboral) }}')">
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

            <div class="modal-footer border-0 justify-content-center">
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
@endsection
