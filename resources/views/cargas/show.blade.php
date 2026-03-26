@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card border-0 shadow-lg">

        {{-- ===================== TITULO ===================== --}}
        <div class="mb-4">
            <h3 class="fw-bold">👨‍👩‍👧 Ficha de Carga Familiar</h3>
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
                            {{ $carga->nombre }} {{ $carga->apellido }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">DNI</label>
                        <div class="form-control bg-light">
                            {{ $carga->dni }}
                        </div>
                    </div>

                </div>

                <div class="row mb-3">

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Parentesco</label>
                        <div class="form-control bg-light">
                            {{ $carga->parentesco }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Fecha Nacimiento</label>
                        <div class="form-control bg-light">
                            {{ $carga->fecha_nacimiento ? \Carbon\Carbon::parse($carga->fecha_nacimiento)->format('d/m/Y') : '-' }}
                        </div>
                    </div>

                </div>

                {{-- ===================== INFO EXTRA HIJO ===================== --}}
                @php
                    $parentesco = strtolower(trim($carga->parentesco));
                    $esHijo = in_array($parentesco, ['hijo','hijastro']);
                @endphp

                @if($esHijo)
                <div class="row">

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Estudia</label>
                        <div class="form-control bg-light">
                            @if($carga->constancia_escolaridad)
                                ✔ Sí
                            @else
                                ❌ No
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Discapacidad</label>
                        <div class="form-control bg-light">
                            @if($carga->certificado_discapacidad)
                                ✔ Sí
                            @else
                                ❌ No
                            @endif
                        </div>
                    </div>

                </div>
                @endif

            </div>
        </div>

        {{-- ===================== DOCUMENTACIÓN ===================== --}}
        @php
            $imagenes = [];

            if ($carga->foto_dni_frente)
                $imagenes[] = asset('storage/' . $carga->foto_dni_frente);

            if ($carga->foto_dni_dorso)
                $imagenes[] = asset('storage/' . $carga->foto_dni_dorso);

            if ($esHijo) {
                if ($carga->partida_nacimiento)
                    $imagenes[] = asset('storage/' . $carga->partida_nacimiento);

                if ($carga->constancia_escolaridad)
                    $imagenes[] = asset('storage/' . $carga->constancia_escolaridad);

                if ($carga->certificado_discapacidad)
                    $imagenes[] = asset('storage/' . $carga->certificado_discapacidad);
            }

            if ($parentesco == 'cónyuge' || $parentesco == 'conyuge') {
                if ($carga->foto_acta_matrimonio)
                    $imagenes[] = asset('storage/' . $carga->foto_acta_matrimonio);
            }
        @endphp

        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header bg-light">
                <strong>📸 Documentación</strong>
            </div>

            <div class="card-body">

                @if(count($imagenes))
                    <div class="row text-center">

                        @foreach($imagenes as $index => $img)
                            <div class="col-md-3 mb-3">
                                <img src="{{ $img }}"
                                    class="img-thumbnail"
                                    style="max-width:150px; cursor:pointer;"
                                    data-index="{{ $index }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalGaleria"
                                    onclick="mostrarImagen({{ $index }})">
                            </div>
                        @endforeach

                    </div>
                @else
                    <div class="text-muted">Sin documentación cargada</div>
                @endif

            </div>
        </div>

        {{-- ===================== BOTONES ===================== --}}
        <div class="text-end">
            <a href="{{ route('cargas.index', $afiliado->id) }}" class="btn btn-secondary btn-lg">
                ↩ Volver
            </a>

            <a href="{{ route('cargas.edit', [$afiliado->id, $carga->id]) }}" class="btn btn-warning btn-lg">
                ✏ Editar
            </a>
        </div>

    </div>
</div>

{{-- ===================== MODAL ===================== --}}
<div class="modal fade" id="modalGaleria" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-dark border-0 text-center">

            <div class="modal-body">
                <img id="imgGrande" src="" class="img-fluid rounded">
            </div>

            <div class="modal-footer justify-content-center border-0">
                <button class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>

{{-- ===================== SCRIPT ===================== --}}
<script>
    let imagenes = @json($imagenes);

    function mostrarImagen(index) {
        document.getElementById('imgGrande').src = imagenes[index];
    }
</script>

@endsection