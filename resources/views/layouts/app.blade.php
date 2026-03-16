<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Afiliación Sindical</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">


    <style>
        .navbar.bg-danger,
        .navbar.bg-danger .nav-link,
        .navbar.bg-danger .navbar-brand {
            color: white !important;
        }
    </style>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">SEOC</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">

                    <!-- Enlaces generales -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('afiliados.index') }}">Afiliados</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('afiliados.solicitudes') }}">Solicitudes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('beneficios.index') }}">Lista de Beneficios</a>
                    </li>
                    <li class="nav-item">
                            <a class="nav-link" href="{{ route('empresas.index') }}">Empresas</a>
                        </li>

                    <!-- Enlaces dependientes de $afiliado -->
                    @isset($afiliado)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cargas.index', $afiliado->id) }}">Cargas Familiares</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pagos_cuotas.index', $afiliado->id) }}">Pagos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('afiliados.beneficios.asignar', $afiliado->id) }}">Beneficios
                                del Afiliado</a>
                        </li>
                        
                    @endisset

                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenedor principal -->
    <div class="container">

        {{-- Mensajes flash de éxito --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        {{-- Mensajes flash de error --}}
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        {{-- Mensajes de validación --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        <!-- Contenido de la vista -->
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
