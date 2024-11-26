<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OcupacionController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\PromocionesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
 });

Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        Route::prefix('promociones')->name('promociones.')->middleware('setCurrentSection:marketing')->group(function () {
        Route::get('/', [PromocionesController::class, 'index'])->name('index'); 
        Route::get('/create', [PromocionesController::class, 'create'])->name('create'); 
        Route::post('/', [PromocionesController::class, 'store'])->name('store'); 
        Route::get('/{promocion}/edit', [PromocionesController::class, 'edit'])->name('edit'); 
        Route::put('/{promocion}', [PromocionesController::class, 'update'])->name('update'); 
        Route::delete('/{promocion}', [PromocionesController::class, 'destroy'])->name('destroy'); 
    });

    Route::prefix('personal')->name('personal.')->middleware('setCurrentSection:personal')->group(function () {
        Route::get('/', [PersonalController::class, 'index'])->name('index'); 
        Route::get('create', [PersonalController::class, 'create'])->name('create'); 
        Route::post('/', [PersonalController::class, 'store'])->name('store'); 
        Route::get('{personal}', [PersonalController::class, 'show'])->name('show'); 
        Route::get('{personal}/edit', [PersonalController::class, 'edit'])->name('edit'); 
        Route::put('{personal}', [PersonalController::class, 'update'])->name('update'); 
        Route::delete('{personal}', [PersonalController::class, 'destroy'])->name('destroy'); 
    });

    Route::prefix('inventario')->name('inventario.')->middleware('setCurrentSection:inventario')->group(function () {
        Route::get('/', [InventarioController::class, 'index'])->name('index');
        Route::get('create', [InventarioController::class, 'create'])->name('create');
        Route::post('/', [InventarioController::class, 'store'])->name('store');
        Route::get('{inventario}', [InventarioController::class, 'show'])->name('show');
        Route::get('{inventario}/edit', [InventarioController::class, 'edit'])->name('edit');
        Route::put('{inventario}', [InventarioController::class, 'update'])->name('update');
        Route::delete('{inventario}', [InventarioController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('clientes')->name('clientes.')->middleware('setCurrentSection:clientes')->group(function () {
        Route::get('/', [ClienteController::class, 'index'])->name('index');  
        Route::get('/crear', [ClienteController::class, 'create'])->name('create');  
        Route::post('/', [ClienteController::class, 'store'])->name('store'); 
        Route::get('/{cliente}', [ClienteController::class, 'show'])->name('show');  
        Route::get('/{cliente}/editar', [ClienteController::class, 'edit'])->name('edit');  
        Route::put('/{cliente}', [ClienteController::class, 'update'])->name('update');  
        Route::delete('/{cliente}', [ClienteController::class, 'destroy'])->name('destroy');  
    });

    Route::get('/ocupacion', [OcupacionController::class, 'index']);

    Route::get('/estadisticas', function () {
        return view('Modulo_Reservaciones.Estadisticas');
    })->middleware('setCurrentSection:reservaciones');

    Route::get('/mapeo', function () {
        return view('Modulo_Reservaciones.Mapeo');
    })->middleware('setCurrentSection:reservaciones');

    Route::get('/facturacion', function () {
        return view('Modulo_Facturas.Dashboard');
    })->name('facturacion')->middleware('setCurrentSection:facturacion');

    Route::get('/listar', function () {
        return view('Modulo_Facturas.Listar');
    })->name('listar')->middleware('setCurrentSection:facturacion');

    Route::get('/reporte', [InventarioController::class, 'filtroPdf'])->name('pdf')->middleware('setCurrentSection:inventario');
    Route::get('/reporte/generar', [InventarioController::class, 'generarPdf'])->name('generar')->middleware('setCurrentSection:inventario');

    Route::get('/reportePersonal', [PersonalController::class, 'filtrar'])->name('pedro')->middleware('setCurrentSection:personal');
    Route::get('/reportePersonal/generar', [PersonalController::class, 'generate'])->name('jesus')->middleware('setCurrentSection:personal');
    //
});

require __DIR__.'/auth.php';