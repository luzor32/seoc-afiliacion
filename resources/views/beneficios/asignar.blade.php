@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Asignar Beneficios a {{ $afiliado->nombre }}</h1>

        <form action="{{ route('afiliados.beneficios.asignar.store', $afiliado) }}" method="POST">
            @csrf

            @foreach ($beneficios as $beneficio)
                <div class="form-check">
                    <input type="checkbox" name="beneficios[]" value="{{ $beneficio->id }}" class="form-check-input"
                        {{ $afiliado->beneficios && $afiliado->beneficios->contains($beneficio->id) ? 'checked' : '' }}>
                    <label class="form-check-label">{{ $beneficio->nombre }}</label>
                </div>
            @endforeach

            <button type="submit" class="btn btn-success mt-3">Guardar</button>
            <a href="{{ route('afiliados.show', $afiliado->id) }}" class="btn btn-secondary mt-3">Volver</a>
        </form>
    </div>
@endsection
