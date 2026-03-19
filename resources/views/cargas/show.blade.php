@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">👨‍👩‍👧 Detalle carga familiar</h3>
    </div>

    <div class="card shadow-lg border-0">

        <div class="card-header bg-light">
            <strong>📋 {{ $carga->nombre }} {{ $carga->apellido }}</strong>
        </div>

        <div class="card-body">

            {{-- DATOS --}}
            <div class="row mb-3">
                <div class="col-md-4"><strong>Parentesco:</strong><br>{{ $carga->parentesco }}</div>
                <div class="col-md-4"><strong>Fecha nacimiento:</strong><br>{{ $carga->fecha_nacimiento ?? '-' }}</div>
                <div class="col-md-4"><strong>DNI:</strong><br>{{ $carga->dni }}</div>
            </div>

            {{-- ===================== GALERIA ===================== --}}
            @php
                $imagenes = [];

                if($carga->dni_frente) $imagenes[] = asset('storage/'.$carga->dni_frente);
                if($carga->dni_dorso) $imagenes[] = asset('storage/'.$carga->dni_dorso);

                if(in_array($carga->parentesco, ['Hijo','Hijastro'])){
                    if($carga->foto_partida_nacimiento) $imagenes[] = asset('storage/'.$carga->foto_partida_nacimiento);
                    if($carga->constancia_escolaridad) $imagenes[] = asset('storage/'.$carga->constancia_escolaridad);
                    if($carga->certificado_discapacidad) $imagenes[] = asset('storage/'.$carga->certificado_discapacidad);
                }

                if($carga->parentesco == 'Cónyuge'){
                    if($carga->foto_acta_matrimonio) $imagenes[] = asset('storage/'.$carga->foto_acta_matrimonio);
                }
            @endphp

            <div class="row mt-4">
                <div class="col-12">
                    <h5 class="text-primary">🖼️ Documentación</h5>
                    <hr>
                </div>

                @foreach($imagenes as $index => $img)
                    <div class="col-md-3 mb-3 text-center">
                        <img src="{{ $img }}"
                             class="img-thumbnail img-click"
                             style="cursor:pointer"
                             data-index="{{ $index }}"
                             width="150">
                    </div>
                @endforeach
            </div>

        </div>

        <div class="card-footer text-end">
            <a href="{{ route('cargas.index', $afiliado->id) }}" class="btn btn-secondary">↩ Volver</a>
            <a href="{{ route('cargas.edit', [$afiliado->id, $carga->id]) }}" class="btn btn-warning">✏ Editar</a>
        </div>

    </div>
</div>

{{-- ===================== MODAL SLIDER ===================== --}}
<div class="modal fade" id="modalGaleria" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-dark text-center">

            <div class="modal-header border-0">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <button id="prevBtn" class="btn btn-light position-absolute start-0 top-50 translate-middle-y">◀</button>

                <img id="imgGrande" src="" class="img-fluid rounded">

                <button id="nextBtn" class="btn btn-light position-absolute end-0 top-50 translate-middle-y">▶</button>
            </div>

        </div>
    </div>
</div>

{{-- ===================== SCRIPT ===================== --}}
<script>
    let imagenes = @json($imagenes);
    let indexActual = 0;

    function mostrarImagen(index) {
        indexActual = index;
        document.getElementById('imgGrande').src = imagenes[index];
    }

    document.querySelectorAll('.img-click').forEach(img => {
        img.addEventListener('click', function () {
            let index = this.getAttribute('data-index');
            mostrarImagen(index);

            let modal = new bootstrap.Modal(document.getElementById('modalGaleria'));
            modal.show();
        });
    });

    document.getElementById('prevBtn').addEventListener('click', function () {
        indexActual = (indexActual - 1 + imagenes.length) % imagenes.length;
        mostrarImagen(indexActual);
    });

    document.getElementById('nextBtn').addEventListener('click', function () {
        indexActual = (indexActual + 1) % imagenes.length;
        mostrarImagen(indexActual);
    });
</script>

@endsection