@php
    $esSolicitud = request('origen') == 'solicitud';
@endphp
@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card border-0 shadow-lg">

            <div class="mb-3">
                <h3 class="fw-bold">
                    📋
                    @if (request('origen') == 'solicitud')
                        Editar Solicitud
                    @else
                        Editar Afiliado
                    @endif
                </h3>
            </div>

            <div class="card-body">

                <form action="{{ route('afiliados.update', $afiliado->id) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PATCH')

                    {{-- ===================== DATOS PERSONALES ===================== --}}

                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-header bg-light"><strong>👤 Datos Personales</strong></div>

                        <div class="card-body">

                            <div class="row mb-3">

                                <div class="col">
                                    <label>Nombre</label>
                                    <input type="text" name="nombre" class="form-control form-control-lg"
                                        value="{{ old('nombre', $afiliado->nombre) }}">
                                </div>

                                <div class="col">
                                    <label>Apellido</label>
                                    <input type="text" name="apellido" class="form-control form-control-lg"
                                        value="{{ old('apellido', $afiliado->apellido) }}">
                                </div>

                            </div>

                            <div class="row">

                                <div class="col">
                                    <label>DNI</label>
                                    <input type="text" name="dni" class="form-control"
                                        value="{{ old('dni', $afiliado->dni) }}">
                                </div>

                                <div class="col">
                                    <label>CUIL</label>
                                    <input type="text" name="cuil" class="form-control"
                                        value="{{ old('cuil', $afiliado->cuil) }}">
                                </div>

                                <div class="col">
                                    <label>Fecha de Nacimiento</label>
                                    <input type="date" name="fecha_nacimiento" class="form-control"
                                        value="{{ old('fecha_nacimiento', $afiliado->fecha_nacimiento?->format('Y-m-d')) }}">
                                </div>

                                <div class="col">
                                    <label>Nacionalidad</label>
                                    <input type="text" name="nacionalidad" class="form-control"
                                        value="{{ old('nacionalidad', $afiliado->nacionalidad) }}">
                                </div>

                            </div>

                        </div>
                    </div>


                    {{-- ===================== DOMICILIO ===================== --}}

                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-header bg-light"><strong>🏠 Domicilio</strong></div>

                        <div class="card-body">

                            <div class="row mb-3">

                                <div class="col">
                                    <label>Provincia</label>
                                    <input type="text" name="provincia" class="form-control"
                                        value="{{ old('provincia', $afiliado->provincia) }}">
                                </div>

                                <div class="col">
                                    <label>Localidad</label>
                                    <input type="text" name="localidad" class="form-control"
                                        value="{{ old('localidad', $afiliado->localidad) }}">
                                </div>

                                <div class="col">
                                    <label>Calle</label>
                                    <input type="text" name="calle" class="form-control"
                                        value="{{ old('calle', $afiliado->calle) }}">
                                </div>

                                <div class="col">
                                    <label>Número</label>
                                    <input type="text" name="numero" class="form-control"
                                        value="{{ old('numero', $afiliado->numero) }}">
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-3">
                                    <label>Código Postal</label>
                                    <input type="text" name="codigo_postal" class="form-control"
                                        value="{{ old('codigo_postal', $afiliado->codigo_postal) }}">
                                </div>
                            </div>

                        </div>
                    </div>


                    {{-- ===================== CONTACTO ===================== --}}

                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-header bg-light"><strong>📞 Contacto</strong></div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col">
                                    <label>Teléfono</label>
                                    <input type="text" name="telefono" class="form-control"
                                        value="{{ old('telefono', $afiliado->telefono) }}">
                                </div>

                                <div class="col">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ old('email', $afiliado->email) }}">
                                </div>

                            </div>

                        </div>
                    </div>


                    {{-- ===================== DATOS LABORALES ===================== --}}

                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-header bg-light"><strong>🏢 Datos Laborales</strong></div>

                        <div class="card-body">

                            <div class="row mb-3">

                                <div class="col">
                                    <label>Empresa</label>
                                    <select name="empresa_id" class="form-select">
                                        <option value="">Seleccionar Empresa</option>

                                        @foreach ($empresas as $empresa)
                                            <option value="{{ $empresa->id }}"
                                                {{ old('empresa_id', $afiliado->empresa_id) == $empresa->id ? 'selected' : '' }}>
                                                {{ $empresa->nombre }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col">
                                    <label>Puesto</label>
                                    <input type="text" name="puesto" class="form-control"
                                        value="{{ old('puesto', $afiliado->puesto) }}">
                                </div>

                            </div>

                            <div class="row">

                                <div class="col">
                                    <label>Tipo de Contrato</label>
                                    <select name="tipo_contrato" class="form-select">
                                        <option value="">Seleccione</option>

                                        <option value="Permanente"
                                            {{ old('tipo_contrato', $afiliado->tipo_contrato) == 'Permanente' ? 'selected' : '' }}>
                                            Permanente
                                        </option>

                                        <option value="Temporal"
                                            {{ old('tipo_contrato', $afiliado->tipo_contrato) == 'Temporal' ? 'selected' : '' }}>
                                            Temporal
                                        </option>

                                    </select>
                                </div>

                                <div class="col">
                                    <label>Jornada Laboral</label>
                                    <select name="jornada_laboral" class="form-select">

                                        <option value="Jornada Completa"
                                            {{ old('jornada_laboral', $afiliado->jornada_laboral) == 'Jornada Completa' ? 'selected' : '' }}>
                                            Jornada Completa
                                        </option>

                                        <option value="Media Jornada"
                                            {{ old('jornada_laboral', $afiliado->jornada_laboral) == 'Media Jornada' ? 'selected' : '' }}>
                                            Media Jornada
                                        </option>

                                    </select>
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

                            <div class="row mb-3">

                                <div class="col">
                                    <label>Número de Afiliado</label>
                                    <input type="text" name="numero_afiliado" class="form-control form-control-lg"
                                        value="{{ old('numero_afiliado', $afiliado->numero_afiliado) }}">
                                </div>

                                <div class="col">
                                    <label class="form-label">Delegación Sindical</label>
                                    <input type="text" name="delegacion_sindical" class="form-control"
                                        value="{{ old('delegacion_sindical') }}">
                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- ===================== CARGAS Y BENEFICIOS ===================== --}}
                    @if (!$esSolicitud && $afiliado->estado_afiliado == 'activo')
                        <div class="card mt-4 border-0 shadow-sm">

                            <div class="card-header bg-light">
                                <strong>👨‍👩‍👧 Gestión del afiliado</strong>
                            </div>

                            <div class="card-body">

                                {{-- ===================== CARGAS FAMILIARES ===================== --}}
                                <h5 class="mb-3">Cargas familiares</h5>

                                <a href="{{ route('cargas.index', $afiliado->id) }}"
                                    class="btn btn-outline-primary mb-3">
                                    👨‍👩‍👧 Ver cargas familiares
                                </a>

                                <a href="{{ route('cargas.create', $afiliado->id) }}" class="btn btn-primary mb-3">
                                    ➕ Nueva carga familiar
                                </a>

                                <hr>

                                {{-- ===================== BENEFICIOS ===================== --}}
                                <h5 class="mb-3">Beneficios</h5>

                                <a href="{{ route('afiliados.beneficios.asignar', $afiliado->id) }}"
                                    class="btn btn-outline-success">
                                    🎁 Gestionar beneficios
                                </a>

                            </div>

                        </div>
                    @endif


                    {{-- ===================== DOCUMENTACION ===================== --}}

                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-header bg-light"><strong>📄 Documentación</strong></div>

                        <div class="card-body">

                            <div class="row">

                                {{-- DNI FRENTE --}}
                                <div class="col text-center">
                                    <label>DNI Frente</label>
                                    <input type="file" name="foto_dni_frente" class="form-control"
                                        onchange="preview(event,'dni_frente')">

                                    @if ($afiliado->foto_dni_frente)
                                        <img src="{{ asset('storage/' . $afiliado->foto_dni_frente) }}" id="dni_frente"
                                            class="img-thumbnail mt-2" style="max-width:150px;">
                                    @else
                                        <img id="dni_frente" class="img-thumbnail mt-2" style="display:none;">
                                    @endif
                                </div>

                                {{-- DNI DORSO --}}
                                <div class="col text-center">
                                    <label>DNI Dorso</label>
                                    <input type="file" name="foto_dni_dorso" class="form-control"
                                        onchange="preview(event,'dni_dorso')">

                                    @if ($afiliado->foto_dni_dorso)
                                        <img src="{{ asset('storage/' . $afiliado->foto_dni_dorso) }}" id="dni_dorso"
                                            class="img-thumbnail mt-2" style="max-width:150px;">
                                    @else
                                        <img id="dni_dorso" class="img-thumbnail mt-2" style="display:none;">
                                    @endif
                                </div>

                                {{-- RECIBO --}}
                                <div class="col text-center">
                                    <label>Recibo de Sueldo</label>
                                    <input type="file" name="foto_recibo_sueldo" class="form-control"
                                        onchange="preview(event,'recibo')">

                                    @if ($afiliado->foto_recibo_sueldo)
                                        <img src="{{ asset('storage/' . $afiliado->foto_recibo_sueldo) }}" id="recibo"
                                            class="img-thumbnail mt-2" style="max-width:150px;">
                                    @else
                                        <img id="recibo" class="img-thumbnail mt-2" style="display:none;">
                                    @endif
                                </div>

                                {{-- CONSTANCIA --}}
                                <div class="col text-center">
                                    <label>Constancia Laboral</label>
                                    <input type="file" name="foto_constancia_laboral" class="form-control"
                                        onchange="preview(event,'constancia')">

                                    @if ($afiliado->foto_constancia_laboral)
                                        <img src="{{ asset('storage/' . $afiliado->foto_constancia_laboral) }}"
                                            id="constancia" class="img-thumbnail mt-2" style="max-width:150px;">
                                    @else
                                        <img id="constancia" class="img-thumbnail mt-2" style="display:none;">
                                    @endif
                                </div>

                            </div>

                        </div>
                    </div>

                    @php
                        $esSolicitud = request('origen') == 'solicitud';
                    @endphp

                    <div class="text-end">

                        {{-- BOTON GUARDAR --}}
                        <button type="submit" class="btn btn-primary btn-lg">
                            💾
                            @if ($esSolicitud)
                                Guardar Solicitud
                            @else
                                Guardar Afiliado
                            @endif
                        </button>

                        {{-- BOTON VOLVER --}}
                        <a href="{{ $esSolicitud ? route('afiliados.solicitudes') : route('afiliados.index') }}"
                            class="btn btn-secondary btn-lg">

                            ↩
                            @if ($esSolicitud)
                                Volver a solicitudes
                            @else
                                Volver a afiliados
                            @endif

                        </a>

                    </div>

                </form>

            </div>
        </div>

    </div>


    <script>
        function preview(event, id) {
            let reader = new FileReader();
            reader.onload = function() {
                let img = document.getElementById(id);
                img.src = reader.result;
                img.style.display = "block";
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
