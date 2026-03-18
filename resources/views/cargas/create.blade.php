@extends('layouts.app')

@section('content')
    <div class="container">

        {{-- ===================== TITULO ===================== --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">
                👨‍👩‍👧 {{ isset($carga) ? 'Editar' : 'Agregar' }} carga familiar
            </h3>


        </div>

        {{-- ===================== MENSAJES ===================== --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- ===================== CARD ===================== --}}
        <div class="card border-0 shadow-sm">

            <div class="card-header bg-light">
                <strong>📋 Datos de la carga familiar de {{ $afiliado->nombre }} {{ $afiliado->apellido }}</strong>
            </div>

            <div class="card-body">

                <form
                    action="{{ isset($carga) ? route('cargas.update', [$afiliado->id, $carga->id]) : route('cargas.store', $afiliado->id) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($carga))
                        @method('PUT')
                    @endif

                    {{-- ===================== DATOS PERSONALES ===================== --}}
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nombre</label>
                            <input type="text" name="nombre" class="form-control"
                                value="{{ old('nombre', $carga->nombre ?? '') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Apellido</label>
                            <input type="text" name="apellido" class="form-control"
                                value="{{ old('apellido', $carga->apellido ?? '') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">DNI</label>
                            <input type="text" name="" class="form-control"
                                value="{{ old('dni', $carga->dni ?? '') }}" required>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Parentesco</label>
                            <select name="parentesco" id="parentesco" class="form-select" required>
                                <option value="">Seleccionar</option>
                                @foreach ($parentescos as $p)
                                    <option value="{{ $p }}"
                                        {{ old('parentesco', $carga->parentesco ?? '') == $p ? 'selected' : '' }}>
                                        {{ $p }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Fecha de nacimiento</label>
                            <input type="date" name="fecha_nacimiento" class="form-control"
                                value="{{ old('fecha_nacimiento', $carga->fecha_nacimiento ?? '') }}">
                        </div>

                    </div>

                    {{-- ===================== DOCUMENTACION ===================== --}}
                    <div class="row hijo-doc" style="display:none;">

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">📄 Partida de nacimiento</label>
                            <input type="file" name="foto_partida_nacimiento" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">🏫 Escolaridad</label>
                            <input type="file" name="constancia_escolaridad" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">♿ Discapacidad</label>
                            <input type="file" name="certificado_discapacidad" class="form-control">
                        </div>

                    </div>

                    <div class="row conyuge-doc" style="display:none;">

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">💍 Acta matrimonio / convivencia</label>
                            <input type="file" name="foto_acta_matrimonio" class="form-control">
                        </div>

                    </div>

                    {{-- ===================== BOTONES ===================== --}}
                    <div class="mt-3 text-end">

                        <button class="btn btn-primary btn-lg">
                            💾 {{ isset($carga) ? 'Actualizar' : 'Guardar' }}
                        </button>
                        <a href="{{ route('afiliados.edit', $afiliado->id) }}" class="btn btn-secondary btn-lg">
                            ↩ Volver
                        </a>

                    </div>

                </form>


            </div>
        </div>

    </div>

    <script>
        function toggleDocs() {
            let parentesco = document.getElementById('parentesco').value;
            document.querySelectorAll('.hijo-doc').forEach(e => e.style.display = (parentesco == 'Hijo') ? 'block' :
                'none');
            document.querySelectorAll('.conyuge-doc').forEach(e => e.style.display = (parentesco == 'Cónyuge') ? 'block' :
                'none');
        }

        document.getElementById('parentesco').addEventListener('change', toggleDocs);
        window.addEventListener('load', toggleDocs);
    </script>
@endsection
