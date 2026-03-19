@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">
                👨‍👩‍👧 {{ isset($carga) ? 'Editar' : 'Agregar' }} carga familiar
            </h3>
        </div>

        {{-- MENSAJES --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
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

        <div class="card border-0 shadow-lg">

            <div class="card-header bg-light">
                <strong>📋 Datos de {{ $afiliado->nombre }} {{ $afiliado->apellido }}</strong>
            </div>

            <div class="card-body">

                <form
                    action="{{ isset($carga) ? route('cargas.update', [$afiliado->id, $carga->id]) : route('cargas.store', $afiliado->id) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($carga))
                        @method('PUT')
                    @endif

                    {{-- DATOS PERSONALES --}}
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

                        {{-- ✅ CORREGIDO --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">DNI</label>
                            <input type="text" name="dni" class="form-control" value="{{ old('dni', $carga->dni ?? '') }}"
                                required>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Parentesco</label>
                            <select name="parentesco" id="parentesco" class="form-select" required>
                                <option value="">Seleccionar</option>
                                @foreach ($parentescos as $p)
                                    <option value="{{ $p }}" {{ old('parentesco', $carga->parentesco ?? '') == $p ? 'selected' : '' }}>
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

                    {{-- DOCUMENTACIÓN HIJO --}}
                    <div class="row hijo-doc" style="display:none;">

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">📄 Partida de nacimiento</label>
                            <input type="file" name="foto_partida_nacimiento" class="form-control">
                        </div>

                        {{-- CHECKBOXES --}}
                        <div class="col-md-2 d-flex align-items-center">
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" id="estudia">
                                <label class="form-check-label fw-bold">Estudia</label>
                            </div>
                        </div>

                        <div class="col-md-2 d-flex align-items-center">
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" id="discapacidad">
                                <label class="form-check-label fw-bold">Discapacidad</label>
                            </div>
                        </div>

                        
                    </div>

                    

                    

                

                    </div>
                    {{-- ===================== DNI ===================== --}}
                    <div class="row mt-3">

                        <div class="col-12">
                            <h5 class="fw-bold text-primary">📘 Documento de Identidad</h5>
                            <hr>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">📷 DNI Frente</label>
                            <input type="file" name="dni_frente" class="form-control">

                            @if(isset($carga) && $carga->dni_frente)
                                <small class="text-success">✔ Ya cargado</small>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">📷 DNI Dorso</label>
                            <input type="file" name="dni_dorso" class="form-control">

                            @if(isset($carga) && $carga->dni_dorso)
                                <small class="text-success">✔ Ya cargado</small>
                            @endif
                        </div>
                        

                        {{-- ESCOLARIDAD --}}
                        <div class="col-md-4 mb-3 escolaridad-doc" style="display:none;">
                            <label class="form-label fw-bold">🏫 Certificado escolaridad</label>
                            <input type="file" name="constancia_escolaridad" class="form-control">
                        </div>

                                {{-- DISCAPACIDAD --}}
                                <div class="col-md-4 mb-3 discapacidad-doc" style="display:none;">
                                    <label class="form-label fw-bold">♿ Certificado discapacidad</label>
                                    <input type="file" name="certificado_discapacidad" class="form-control">
                                </div>

                                {{-- CONYUGE --}}
                            <div class="row conyuge-doc" style="display:none;">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">💍 Acta matrimonio</label>
                                    <input type="file" name="foto_acta_matrimonio" class="form-control">
                                </div>
                            </div>


                    </div>
                    {{-- BOTONES --}}
                    <div class="mt-3 text-end">
                                <button class="btn btn-primary btn-lg">
                                    💾 {{ isset($carga) ? 'Actualizar' : 'Guardar' }}
                                </button>
                                <a href="{{ route('afiliados.edit', $afiliado->id) }}" class="btn btn-secondary btn-lg">
                                    ↩ Volver
                                </a>
                            </div>

                            
        </div>
    </div>

    {{-- SCRIPT --}}
    <script>
        function toggleDocs() {
            let parentesco = document.getElementById('parentesco').value;
            let esHijo = (parentesco === 'Hijo' || parentesco === 'Hijastro');

            document.querySelector('.hijo-doc').style.display = esHijo ? 'flex' : 'none';
            document.querySelector('.conyuge-doc').style.display = (parentesco === 'Cónyuge') ? 'flex' : 'none';

            if (!esHijo) {
                document.getElementById('estudia').checked = false;
                document.getElementById('discapacidad').checked = false;
                toggleExtras();
            }
        }

        function toggleExtras() {
            let estudia = document.getElementById('estudia').checked;
            let discapacidad = document.getElementById('discapacidad').checked;

            document.querySelector('.escolaridad-doc').style.display = estudia ? 'block' : 'none';
            document.querySelector('.discapacidad-doc').style.display = discapacidad ? 'block' : 'none';
        }

        document.getElementById('parentesco').addEventListener('change', toggleDocs);
        document.getElementById('estudia').addEventListener('change', toggleExtras);
        document.getElementById('discapacidad').addEventListener('change', toggleExtras);

        window.addEventListener('load', function () {
            toggleDocs();
            toggleExtras();
        });
    </script>

@endsection