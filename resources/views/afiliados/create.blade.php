@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Solicitud de Afiliación</h2>
    <form action="{{ route('afiliados.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <h5>Datos Personales</h5>
        <div class="row mb-2">
            <div class="col">
                <input type="text" name="numero_afiliado" class="form-control" placeholder="Número de Afiliado" value="{{ old('numero_afiliado') }}" required>
            </div>
            <div class="col">
                <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="{{ old('nombre') }}" required>
            </div>
            <div class="col">
                <input type="text" name="apellido" class="form-control" placeholder="Apellido" value="{{ old('apellido') }}" required>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col">
                <input type="text" name="dni" class="form-control" placeholder="DNI" value="{{ old('dni') }}" required>
            </div>
            <div class="col">
                <input type="text" name="cuil" class="form-control" placeholder="CUIL" value="{{ old('cuil') }}">
            </div>
            <div class="col">
                <input type="date" name="fecha_nacimiento" class="form-control" placeholder="Fecha de Nacimiento" value="{{ old('fecha_nacimiento') }}">
            </div>
        </div>

        <h5>Domicilio</h5>
        <div class="row mb-2">
            <div class="col"><input type="text" name="provincia" class="form-control" placeholder="Provincia" value="{{ old('provincia') }}"></div>
            <div class="col"><input type="text" name="localidad" class="form-control" placeholder="Localidad" value="{{ old('localidad') }}"></div>
            <div class="col"><input type="text" name="calle" class="form-control" placeholder="Calle" value="{{ old('calle') }}"></div>
            <div class="col"><input type="text" name="numero" class="form-control" placeholder="Número" value="{{ old('numero') }}"></div>
        </div>
        <div class="row mb-2">
            <div class="col"><input type="text" name="codigo_postal" class="form-control" placeholder="Código Postal" value="{{ old('codigo_postal') }}"></div>
        </div>

        <h5>Contacto</h5>
        <div class="row mb-2">
            <div class="col"><input type="text" name="telefono" class="form-control" placeholder="Teléfono" value="{{ old('telefono') }}"></div>
            <div class="col"><input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}"></div>
        </div>

        <h5>Datos Laborales</h5>
        <div class="row mb-2">
            <div class="col">
                <select name="empresa_id" class="form-control" required>
                    <option value="">Seleccionar Empresa</option>
                    @foreach($empresas as $empresa)
                        <option value="{{ $empresa->id }}" {{ old('empresa_id') == $empresa->id ? 'selected' : '' }}>{{ $empresa->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col"><input type="text" name="puesto" class="form-control" placeholder="Puesto" value="{{ old('puesto') }}"></div>
            <div class="col"><input type="text" name="categoria_laboral" class="form-control" placeholder="Categoría Laboral" value="{{ old('categoria_laboral') }}"></div>
        </div>
        <div class="row mb-2">
            <div class="col"><input type="text" name="seccion" class="form-control" placeholder="Sección" value="{{ old('seccion') }}"></div>
            <div class="col"><input type="text" name="tipo_contrato" class="form-control" placeholder="Tipo de Contrato" value="{{ old('tipo_contrato') }}"></div>
            <div class="col"><input type="text" name="jornada_laboral" class="form-control" placeholder="Jornada Laboral" value="{{ old('jornada_laboral') }}"></div>
        </div>

        <h5>Documentación</h5>
        <div class="row mb-2">
            <div class="col"><input type="file" name="foto_dni_frente" class="form-control"></div>
            <div class="col"><input type="file" name="foto_dni_dorso" class="form-control"></div>
            <div class="col"><input type="file" name="foto_recibo_sueldo" class="form-control"></div>
            <div class="col"><input type="file" name="foto_constancia_laboral" class="form-control"></div>
        </div>

        <h5>Observaciones</h5>
        <textarea name="observaciones" class="form-control mb-3">{{ old('observaciones') }}</textarea>

        <button type="submit" class="btn btn-primary">Enviar Solicitud</button>
    </form>
</div>
@endsection
