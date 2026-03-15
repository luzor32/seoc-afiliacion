@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Empresa</h1>
    <form action="{{ route('empresas.update', $empresa->id) }}" method="POST">
        @method('PATCH')
        @include('empresas.form')
    </form>
</div>
@endsection
