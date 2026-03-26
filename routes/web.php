<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AfiliadoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\CargaFamiliarController;
use App\Http\Controllers\PagoCuotaController;
use App\Http\Controllers\BeneficioController;

// ----------------------
// Home
// ----------------------
Route::get('/', function () {
    return view('welcome');
});

// ----------------------
// AFILIADOS
// ----------------------

// Solicitudes
Route::get('afiliados/solicitudes', [AfiliadoController::class, 'solicitudes'])
    ->name('afiliados.solicitudes');

// Acciones sobre solicitud / afiliado
Route::post('/afiliados/{id}/aprobar', [AfiliadoController::class, 'aprobar'])
    ->name('afiliados.aprobar');

Route::post('/afiliados/{id}/rechazar', [AfiliadoController::class, 'rechazar'])
    ->name('afiliados.rechazar');

Route::post('/afiliados/{id}/activar', [AfiliadoController::class, 'activar'])
    ->name('afiliados.activar');

Route::post('/afiliados/{id}/suspender', [AfiliadoController::class, 'suspender'])
    ->name('afiliados.suspender');

// Resource principal
Route::resource('afiliados', AfiliadoController::class)
    ->parameters(['afiliados' => 'afiliado']);


// ----------------------
// EMPRESAS
// ----------------------
Route::resource('empresas', EmpresaController::class);


// ----------------------
// CARGAS FAMILIARES
// ----------------------
Route::prefix('afiliados/{afiliado}/cargas')->group(function () {

    Route::get('/', [CargaFamiliarController::class, 'index'])->name('cargas.index');

    Route::get('/create', [CargaFamiliarController::class, 'create'])->name('cargas.create');

    Route::post('/store', [CargaFamiliarController::class, 'store'])->name('cargas.store');

    Route::get('/{id}', [CargaFamiliarController::class, 'show'])->name('cargas.show');

    Route::get('/{id}/edit', [CargaFamiliarController::class, 'edit'])->name('cargas.edit');

    Route::put('/{id}', [CargaFamiliarController::class, 'update'])->name('cargas.update');

    Route::delete('/{id}', [CargaFamiliarController::class, 'destroy'])->name('cargas.destroy');

});


// ----------------------
// PAGOS DE CUOTAS
// ----------------------
Route::prefix('afiliados/{afiliado}/pagos')->group(function () {

    Route::get('/', [PagoCuotaController::class, 'index'])->name('pagos_cuotas.index');

    Route::get('/create', [PagoCuotaController::class, 'create'])->name('pagos_cuotas.create');

    Route::post('/', [PagoCuotaController::class, 'store'])->name('pagos_cuotas.store');

    Route::get('/{id}/edit', [PagoCuotaController::class, 'edit'])->name('pagos_cuotas.edit');

    Route::put('/{id}', [PagoCuotaController::class, 'update'])->name('pagos_cuotas.update');

    Route::delete('/{id}', [PagoCuotaController::class, 'destroy'])->name('pagos_cuotas.destroy');

});


// ----------------------
// BENEFICIOS
// ----------------------
Route::resource('beneficios', BeneficioController::class)
    ->parameters(['beneficios' => 'beneficio']);

// Asignar beneficios a afiliado
Route::get('afiliados/{afiliado}/beneficios', [BeneficioController::class, 'asignarForm'])
    ->name('afiliados.beneficios.asignar');

Route::post('afiliados/{afiliado}/beneficios', [BeneficioController::class, 'asignar'])
    ->name('afiliados.beneficios.asignar.store');


Route::post('/afiliados/{id}/baja', [AfiliadoController::class, 'baja'])->name('afiliados.baja');
Route::post('/afiliados/{id}/alta-directa', [AfiliadoController::class, 'altaDirecta'])->name('afiliados.altaDirecta');
Route::get('/afiliados/{id}/historial', [AfiliadoController::class, 'historial'])
    ->name('afiliados.historial');