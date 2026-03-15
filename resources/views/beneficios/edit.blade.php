@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Beneficio</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('beneficios.update', $beneficio) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $beneficio->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control">{{ old('descripcion', $beneficio->descripcion) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" class="form-control">
                <option value="1" {{ old('estado', $beneficio->estado) == 1 ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ old('estado', $beneficio->estado) == 0 ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('beneficios.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
