@csrf

<div class="mb-3">
    <label>Nombre</label>
    <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $empresa->nombre ?? '') }}">
</div>

<div class="mb-3">
    <label>CUIT</label>
    <input type="text" name="cuit" class="form-control" value="{{ old('cuit', $empresa->cuit ?? '') }}">
</div>

<div class="mb-3">
    <label>Dirección</label>
    <input type="text" name="direccion" class="form-control"
        value="{{ old('direccion', $empresa->direccion ?? '') }}">
</div>

<div class="mb-3">
    <label>Teléfono</label>
    <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $empresa->telefono ?? '') }}">
</div>

<div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $empresa->email ?? '') }}">
</div>

<div class="mb-3">
    <label>Actividad</label>
    <input type="text" name="actividad" class="form-control"
        value="{{ old('actividad', $empresa->actividad ?? '') }}">
</div>

<div class="mb-3">
    <label>Estado</label>
    <select name="estado" class="form-control">
        <option value="activa" {{ old('estado', $empresa->estado ?? '') == 'activa' ? 'selected' : '' }}>Activa
        </option>
        <option value="inactiva" {{ old('estado', $empresa->estado ?? '') == 'inactiva' ? 'selected' : '' }}>Inactiva
        </option>
    </select>
</div>

<button type="submit" class="btn btn-success">Guardar</button>
<a href="{{ route('empresas.index') }}" class="btn btn-secondary">Cancelar</a>
