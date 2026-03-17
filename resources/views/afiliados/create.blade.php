@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card border-0 shadow-lg">

            <div class="card-header bg-danger text-white">
                <h4 class="mb-0">📝 Nueva Solicitud de Afiliación</h4>
            </div>

            <div class="card-body">

                <form action="{{ route('afiliados.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf


                    {{-- ===================== DATOS PERSONALES ===================== --}}

                    <div class="card mb-4 border-0 shadow-sm">

                        <div class="card-header bg-light">
                            <strong>👤 Datos Personales</strong>
                        </div>

                        <div class="card-body">

                            <div class="row mb-3">

                                <div class="col">
                                    <label class="form-label">Nombre</label>
                                    <input type="text" name="nombre" class="form-control form-control-lg"
                                        value="{{ old('nombre') }}" required>
                                </div>

                                <div class="col">
                                    <label class="form-label">Apellido</label>
                                    <input type="text" name="apellido" class="form-control form-control-lg"
                                        value="{{ old('apellido') }}" required>
                                </div>

                            </div>


                            <div class="row">

                                <div class="col">
                                    <label class="form-label">DNI</label>
                                    <input type="text" name="dni" class="form-control" value="{{ old('dni') }}"
                                        required>
                                </div>

                                <div class="col">
                                    <label class="form-label">CUIL</label>
                                    <input type="text" name="cuil" class="form-control" value="{{ old('cuil') }}">
                                </div>

                                <div class="col">
                                    <label class="form-label">Fecha de Nacimiento</label>
                                    <input type="date" name="fecha_nacimiento" class="form-control"
                                        value="{{ old('fecha_nacimiento') }}">
                                </div>

                                <div class="col">
                                    <label class="form-label">Nacionalidad</label>
                                    <input type="text" name="nacionalidad" class="form-control"
                                        value="{{ old('nacionalidad') }}">
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

                                <div class="col">
                                    <label class="form-label">Provincia</label>
                                    <input type="text" name="provincia" class="form-control"
                                        value="{{ old('provincia') }}">
                                </div>

                                <div class="col">
                                    <label class="form-label">Localidad</label>
                                    <input type="text" name="localidad" class="form-control"
                                        value="{{ old('localidad') }}">
                                </div>

                                <div class="col">
                                    <label class="form-label">Calle</label>
                                    <input type="text" name="calle" class="form-control" value="{{ old('calle') }}">
                                </div>

                                <div class="col">
                                    <label class="form-label">Número</label>
                                    <input type="text" name="numero" class="form-control" value="{{ old('numero') }}">
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-3">
                                    <label class="form-label">Código Postal</label>
                                    <input type="text" name="codigo_postal" class="form-control"
                                        value="{{ old('codigo_postal') }}">
                                </div>

                            </div>

                        </div>
                    </div>


                    {{-- ===================== CONTACTO ===================== --}}

                    <div class="card mb-4 border-0 shadow-sm">

                        <div class="card-header bg-light">
                            <strong>📞 Contacto</strong>
                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col">
                                    <label class="form-label">Teléfono</label>
                                    <input type="text" name="telefono" class="form-control"
                                        value="{{ old('telefono') }}">
                                </div>

                                <div class="col">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ old('email') }}">
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

                                <div class="col">
                                    <label class="form-label">Empresa</label>

                                    <select name="empresa_id" class="form-select" required>

                                        <option value="">Seleccionar Empresa</option>

                                        @foreach ($empresas as $empresa)
                                            <option value="{{ $empresa->id }}"
                                                {{ old('empresa_id') == $empresa->id ? 'selected' : '' }}>

                                                {{ $empresa->nombre }}

                                            </option>
                                        @endforeach

                                    </select>

                                </div>

                                <div class="col">
                                    <label class="form-label">Puesto</label>
                                    <input type="text" name="puesto" class="form-control"
                                        value="{{ old('puesto') }}">
                                </div>

                            </div>


                            <div class="row">

                                <div class="col">

                                    <label class="form-label">Tipo de Contrato</label>

                                    <select name="tipo_contrato" class="form-select">

                                        <option value="">Seleccione tipo de contrato</option>

                                        <option value="Permanente"
                                            {{ old('tipo_contrato') == 'Permanente' ? 'selected' : '' }}>
                                            Permanente
                                        </option>

                                        <option value="Temporal"
                                            {{ old('tipo_contrato') == 'Temporal' ? 'selected' : '' }}>
                                            Temporal
                                        </option>

                                    </select>

                                </div>


                                <div class="col">

                                    <label class="form-label">Jornada Laboral</label>

                                    <select name="jornada_laboral" class="form-select">

                                        <option value="">Seleccione jornada</option>

                                        <option value="Jornada Completa"
                                            {{ old('jornada_laboral') == 'Jornada Completa' ? 'selected' : '' }}>
                                            Jornada Completa
                                        </option>

                                        <option value="Media Jornada"
                                            {{ old('jornada_laboral') == 'Media Jornada' ? 'selected' : '' }}>
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
                                    <label class="form-label">Número de Afiliado</label>
                                    <input type="text" name="numero_afiliado" class="form-control form-control-lg"
                                        value="{{ old('numero_afiliado') }}">
                                </div>

                                <div class="col">
                                    <label class="form-label">Delegación Sindical</label>
                                    <input type="text" name="delegacion_sindical" class="form-control"
                                        value="{{ old('delegacion_sindical') }}">
                                </div>

                            </div>

                        </div>
                    </div>


                    {{-- ===================== DOCUMENTACION ===================== --}}

                    <div class="card mb-4 border-0 shadow-sm">

                        <div class="card-header bg-light">
                            <strong>📄 Documentación</strong>
                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col text-center">

                                    <label class="form-label">DNI Frente</label>

                                    <input type="file" name="foto_dni_frente" class="form-control"
                                        onchange="preview(event,'dni_frente')">

                                    <img id="dni_frente" class="img-thumbnail mt-2"
                                        style="max-width:150px; display:none;">

                                </div>


                                <div class="col text-center">

                                    <label class="form-label">DNI Dorso</label>

                                    <input type="file" name="foto_dni_dorso" class="form-control"
                                        onchange="preview(event,'dni_dorso')">

                                    <img id="dni_dorso" class="img-thumbnail mt-2"
                                        style="max-width:150px; display:none;">

                                </div>


                                <div class="col text-center">

                                    <label class="form-label">Recibo de Sueldo</label>

                                    <input type="file" name="foto_recibo_sueldo" class="form-control"
                                        onchange="preview(event,'recibo')">

                                    <img id="recibo" class="img-thumbnail mt-2"
                                        style="max-width:150px; display:none;">

                                </div>


                                <div class="col text-center">

                                    <label class="form-label">Constancia Laboral</label>

                                    <input type="file" name="foto_constancia_laboral" class="form-control"
                                        onchange="preview(event,'constancia')">

                                    <img id="constancia" class="img-thumbnail mt-2"
                                        style="max-width:150px; display:none;">

                                </div>

                            </div>

                        </div>
                    </div>


                    <div class="mb-4">

                      


                    <div class="text-end">

                        <button type="submit" class="btn btn-success btn-lg">
                            💾 Guardar Solicitud
                        </button>

                        <a href="{{ route('afiliados.solicitudes') }}" class="btn btn-secondary btn-lg">
                            ↩ Volver
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
