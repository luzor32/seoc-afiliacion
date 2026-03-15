@extends('layouts.app')

@section('content')
<div class="container">
    <h3>{{ isset($carga) ? 'Editar' : 'Agregar' }} carga familiar de {{ $afiliado->nombre }} {{ $afiliado->apellido }}</h3>

    <!-- Mensajes flash -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

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

    <form action="{{ isset($carga) ? route('cargas.update', [$afiliado->id, $carga->id]) : route('cargas.store', $afiliado->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($carga))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $carga->nombre ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label>Apellido</label>
            <input type="text" name="apellido" class="form-control" value="{{ old('apellido', $carga->apellido ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label>Parentesco</label>
            <select name="parentesco" id="parentesco" class="form-control" required>
                <option value="">Seleccionar</option>
                @foreach($parentescos as $p)
                    <option value="{{ $p }}" {{ (old('parentesco', $carga->parentesco ?? '') == $p) ? 'selected' : '' }}>{{ $p }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Fecha de nacimiento</label>
            <input type="date" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento', $carga->fecha_nacimiento ?? '') }}">
        </div>

        <div class="mb-3 hijo-doc" style="display:none;">
            <label>Foto de partida de nacimiento</label>
            <input type="file" name="foto_partida_nacimiento" class="form-control">
        </div>

        <div class="mb-3 hijo-doc" style="display:none;">
            <label>Constancia de escolaridad</label>
            <input type="file" name="constancia_escolaridad" class="form-control">
        </div>

        <div class="mb-3 hijo-doc" style="display:none;">
            <label>Certificado de discapacidad</label>
            <input type="file" name="certificado_discapacidad" class="form-control">
        </div>

        <div class="mb-3 conyuge-doc" style="display:none;">
            <label>Foto de acta de matrimonio/convivencia</label>
            <input type="file" name="foto_acta_matrimonio" class="form-control">
        </div>

        <button class="btn btn-success">{{ isset($carga) ? 'Actualizar' : 'Guardar' }}</button>
    </form>
</div>

<script>
    function toggleDocs() {
        let parentesco = document.getElementById('parentesco').value;
        document.querySelectorAll('.hijo-doc').forEach(e => e.style.display = (parentesco == 'Hijo') ? 'block' : 'none');
        document.querySelectorAll('.conyuge-doc').forEach(e => e.style.display = (parentesco == 'Cónyuge') ? 'block' : 'none');
    }

    document.getElementById('parentesco').addEventListener('change', toggleDocs);
    window.addEventListener('load', toggleDocs);
</script>
@endsection
