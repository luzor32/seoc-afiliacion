@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nueva Empresa</h1>
    <form action="{{ route('empresas.store') }}" method="POST">
        @include('empresas.form')
    </form>
</div>
@endsection
