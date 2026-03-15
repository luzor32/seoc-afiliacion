@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Editar Afiliado</h2>

        @if (session('mensaje'))
            <div class="alert alert-success">{{ session('mensaje') }}</div>
        @endif

        <form action="{{ route('afiliados.update', $afiliado->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <h5>Datos Personales</h5>
            <div class="row mb-2">
                <div class="col">
                    <input type="text" name="numero_afiliado" class="form-control" placeholder="Número de Afiliado"
                        value="{{ old('numero_afiliado', $afiliado->numero_afiliado) }}" required>
                </div>
                <div class="col">
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre"
                        value="{{ old('nombre', $afiliado->nombre) }}" required>
                </div>
                <div class="col">
                    <input type="text" name="apellido" class="form-control" placeholder="Apellido"
                        value="{{ old('apellido', $afiliado->apellido) }}" required>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col">
                    <input type="text" name="dni" class="form-control" placeholder="DNI"
                        value="{{ old('dni', $afiliado->dni) }}" required>
                </div>
                <div class="col">
                    <input type="text" name="cuil" class="form-control" placeholder="CUIL"
                        value="{{ old('cuil', $afiliado->cuil) }}">
                </div>
                <div class="col">
                    <input type="date" name="fecha_nacimiento" class="form-control"
                        value="{{ old('fecha_nacimiento', $afiliado->fecha_nacimiento?->format('Y-m-d')) }}">
                </div>
            </div>

            <h5>Domicilio</h5>
            <div class="row mb-2">
                <div class="col"><input type="text" name="provincia" class="form-control" placeholder="Provincia"
                        value="{{ old('provincia', $afiliado->provincia) }}"></div>
                <div class="col"><input type="text" name="localidad" class="form-control" placeholder="Localidad"
                        value="{{ old('localidad', $afiliado->localidad) }}"></div>
                <div class="col"><input type="text" name="calle" class="form-control" placeholder="Calle"
                        value="{{ old('calle', $afiliado->calle) }}"></div>
                <div class="col"><input type="text" name="numero" class="form-control" placeholder="Número"
                        value="{{ old('numero', $afiliado->numero) }}"></div>
            </div>
            <div class="row mb-2">
                <div class="col"><input type="text" name="codigo_postal" class="form-control"
                        placeholder="Código Postal" value="{{ old('codigo_postal', $afiliado->codigo_postal) }}"></div>
            </div>

            <h5>Contacto</h5>
            <div class="row mb-2">
                <div class="col"><input type="text" name="telefono" class="form-control" placeholder="Teléfono"
                        value="{{ old('telefono', $afiliado->telefono) }}"></div>
                <div class="col"><input type="email" name="email" class="form-control" placeholder="Email"
                        value="{{ old('email', $afiliado->email) }}"></div>
            </div>

            <h5>Datos Laborales</h5>
            <div class="row mb-2">
                <div class="col">
                    <select name="empresa_id" class="form-control" required>
                        <option value="">Seleccionar Empresa</option>
                        @foreach ($empresas as $empresa)
                            <option value="{{ $empresa->id }}"
                                {{ old('empresa_id', $afiliado->empresa_id) == $empresa->id ? 'selected' : '' }}>
                                {{ $empresa->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col"><input type="text" name="puesto" class="form-control" placeholder="Puesto"
                        value="{{ old('puesto', $afiliado->puesto) }}"></div>
                <div class="col"><input type="text" name="categoria_laboral" class="form-control"
                        placeholder="Categoría Laboral"
                        value="{{ old('categoria_laboral', $afiliado->categoria_laboral) }}"></div>
            </div>
            <div class="row mb-2">
                <div class="col"><input type="text" name="seccion" class="form-control" placeholder="Sección"
                        value="{{ old('seccion', $afiliado->seccion) }}"></div>
                <div class="col"><input type="text" name="tipo_contrato" class="form-control"
                        placeholder="Tipo de Contrato" value="{{ old('tipo_contrato', $afiliado->tipo_contrato) }}">
                </div>
                <div class="col"><input type="text" name="jornada_laboral" class="form-control"
                        placeholder="Jornada Laboral" value="{{ old('jornada_laboral', $afiliado->jornada_laboral) }}">
                </div>
            </div>

            <h5>Datos Sindicales</h5>
            <div class="row mb-2">
                <div class="col"><input type="date" name="fecha_afiliacion" class="form-control"
                        value="{{ old('fecha_afiliacion', $afiliado->fecha_afiliacion?->format('Y-m-d')) }}"></div>
                <div class="col"><input type="text" name="seccional" class="form-control" placeholder="Seccional"
                        value="{{ old('seccional', $afiliado->seccional) }}"></div>
                <div class="col"><input type="text" name="delegacion_sindical" class="form-control"
                        placeholder="Delegación Sindical"
                        value="{{ old('delegacion_sindical', $afiliado->delegacion_sindical) }}"></div>
            </div>

            <h5>Baja Sindical</h5>
            <div class="row mb-2">
                <div class="col"><input type="date" name="fecha_baja" class="form-control"
                        value="{{ old('fecha_baja', $afiliado->fecha_baja?->format('Y-m-d')) }}"></div>
                <div class="col"><input type="text" name="motivo_baja" class="form-control"
                        placeholder="Motivo de Baja" value="{{ old('motivo_baja', $afiliado->motivo_baja) }}"></div>
            </div>

            <h5>Documentación</h5>
            <div class="row mb-2">
                <div class="col"><input type="file" name="foto_dni_frente" class="form-control"></div>
                <div class="col"><input type="file" name="foto_dni_dorso" class="form-control"></div>
                <div class="col"><input type="file" name="foto_recibo_sueldo" class="form-control"></div>
                <div class="col"><input type="file" name="foto_constancia_laboral" class="form-control"></div>
            </div>

            <h5>Observaciones</h5>
            <textarea name="observaciones" class="form-control mb-3">{{ old('observaciones', $afiliado->observaciones) }}</textarea>

            <button type="submit" class="btn btn-primary">Actualizar Afiliado</button>
            <a href="{{ route('afiliados.index', $afiliado->id) }}" class="btn btn-secondary mt-3">Volver</a>
        </form>
    </div>
@endsection
