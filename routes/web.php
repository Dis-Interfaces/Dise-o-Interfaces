<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OcupacionController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\PromocionesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrdenCompraController;
use FontLib\Table\Type\name;
use App\Http\Controllers\ReservacionesController;

Route::middleware(['setCurrentSection:reservaciones', 'role:1,2,3'])->group(function () {
    Route::get('/reservaciones/create', [ReservacionesController::class, 'create'])->name('reservaciones.create');
    Route::post('/reservaciones', [ReservacionesController::class, 'store'])->name('reservaciones.store');
    Route::post('/reservaciones2', [ReservacionesController::class, 'store2'])->name('reservaciones.store2');
    Route::get('/reservaciones/{id}', [ReservacionesController::class, 'show'])->name('reservaciones.show');
    Route::get('/reservaciones/{id}/edit', [ReservacionesController::class, 'edit'])->name('reservaciones.edit');
    Route::put('/reservaciones/{id}', [ReservacionesController::class, 'update'])->name('reservaciones.update');
    Route::delete('/reservaciones/{id}', [ReservacionesController::class, 'destroy'])->name('reservaciones.destroy');
    Route::get('/reservaciones', [ReservacionesController::class, 'index'])->name('reservaciones.index');
});
Route::post('/api/actualizar-inventario', [InventarioController::class, 'actualizarInventario']);
Route::get('/api/filtrar-datos', [ReservacionesController::class, 'filtrarDatos']);
Route::get('/api/habitaciones-inventario', [ReservacionesController::class, 'getHabitacionesInventario']);



Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
            return redirect()->route('ocupacion.index');
        })->name('dashboard');


   
    Route::get('/facturacion', function () {
        return view('Modulo_Facturas.Dashboard');
    })->name('facturacion')->middleware('setCurrentSection:facturacion');

    Route::get('/listar', function () {
        return view('Modulo_Facturas.Listar');
    })->name('listar')->middleware('setCurrentSection:facturacion');

    Route::get('/estadisticas', [OcupacionController::class, 'estadisticasHabitaciones'])->name('estadisticas.habitaciones')->middleware(['setCurrentSection:reservaciones','role:2,3']);


    Route::prefix('habitaciones')->name('habitaciones.')->middleware(['setCurrentSection:habitaciones','role:2,3'])->group(function() {
        Route::get('/', [HabitacionController::class, 'index'])->name('index');
        Route::get('create', [HabitacionController::class, 'create'])->name('create');  
        Route::post('store', [HabitacionController::class, 'store'])->name('store'); 
        Route::get('edit/{id}', [HabitacionController::class, 'edit'])->name('edit'); 
        Route::put('update/{id}', [HabitacionController::class, 'update'])->name('update');  
        Route::delete('destroy/{id}', [HabitacionController::class, 'destroy'])->name('destroy'); 
    });

    Route::get('/', [OcupacionController::class, 'indexhabitaciones'])->name('ocupacion.index')->middleware(['setCurrentSection:ocupacion','role:2,3']);

    Route::prefix('clientes')->name('clientes.')->middleware(['setCurrentSection:clientes','role:2,3'])->group(function() {
        // rutas para los clientes rol 1
        Route::get('/', [UsersController::class, 'indexClientes'])->name('index'); 
        Route::get('create', [UsersController::class, 'createCliente'])->name('create');  
        Route::post('store', [UsersController::class, 'storeCliente'])->name('store'); 
        Route::get('edit/{id}', [UsersController::class, 'editCliente'])->name('edit'); 
        Route::put('update/{id}', [UsersController::class, 'updateCliente'])->name('update');  
        Route::delete('destroy/{id}', [UsersController::class, 'destroyCliente'])->name('destroy');  
        Route::get('clientes/tabla', [UsersController::class, 'tablaClientes'])->name('tabla');
    });

    Route::prefix('personal')->name('personal.')->middleware(['setCurrentSection:personal','role:2,3'])->group(function() {
        // rutas para los trabajadores y administradores roles 2 y 3
        Route::get('/', [UsersController::class, 'indexPersonal'])->name('index');  
        Route::get('create', [UsersController::class, 'createPersonal'])->name('create');  
        Route::post('store', [UsersController::class, 'storePersonal'])->name('store');  
        Route::get('edit/{id}', [UsersController::class, 'editPersonal'])->name('edit');  
        Route::put('update/{id}', [UsersController::class, 'updatePersonal'])->name('update');  
        Route::delete('destroy/{id}', [UsersController::class, 'destroyPersonal'])->name('destroy');  
        Route::get('personal/tabla', [UsersController::class, 'tablaPersonal'])->name('tabla');
    });

    Route::prefix('inventario')->name('inventario.')->middleware(['setCurrentSection:inventario','role:2,3'])->group(function () {
        Route::get('/', [InventarioController::class, 'index'])->name('index');
        Route::get('create', [InventarioController::class, 'create'])->name('create');
        Route::post('/', [InventarioController::class, 'store'])->name('store');
        Route::get('{inventario}', [InventarioController::class, 'show'])->name('show');
        Route::get('{inventario}/edit', [InventarioController::class, 'edit'])->name('edit');
        Route::put('{inventario}', [InventarioController::class, 'update'])->name('update');
        Route::delete('{inventario}', [InventarioController::class, 'destroy'])->name('destroy');
        Route::post('/decrement/{id}', [InventarioController::class, 'decrement'])->name('decrement');
        Route::post('/restock/{id}', [InventarioController::class, 'createRestockOrder'])->name('createRestockOrder');
    });

    Route::get('/reporte', [InventarioController::class, 'filtroPdf'])->name('pdf')->middleware(['setCurrentSection:inventario','role:2,3']);
    Route::get('/reporte/generar', [InventarioController::class, 'generarPdf'])->name('generar')->middleware(['setCurrentSection:inventario','role:2,3']);

    Route::get('/reportePersonal', [PersonalController::class, 'filtrar'])->name('pedro')->middleware('setCurrentSection:personal');
    Route::get('/reportePersonal/generar', [PersonalController::class, 'generate'])->name('jesus')->middleware('setCurrentSection:personal');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show')->middleware('setCurrentSection:profile');

    Route::prefix('promociones')->name('promociones.')->middleware(['setCurrentSection:marketing','role:2,3'])->group(function () {
        Route::get('/', [PromocionesController::class, 'index'])->name('index'); 
        Route::get('/create', [PromocionesController::class, 'create'])->name('create'); 
        Route::post('/', [PromocionesController::class, 'store'])->name('store'); 
        Route::get('/{promocion}/edit', [PromocionesController::class, 'edit'])->name('edit'); 
        Route::put('/{promocion}', [PromocionesController::class, 'update'])->name('update'); 
        Route::delete('/{promocion}', [PromocionesController::class, 'destroy'])->name('destroy'); 
    });

    Route::prefix('ordenes-compra')->name('ordenes-compra.')->middleware('setCurrentSection:inventario')->group(function () {
        Route::get('/', [OrdenCompraController::class, 'index'])->name('index');
        Route::post('store', [OrdenCompraController::class, 'store'])->name('store');
        Route::delete('destroy/{id}', [OrdenCompraController::class, 'destroy'])->name('destroy');
        Route::get('restock/{id}', [OrdenCompraController::class, 'printOrder'])->name('print');
    });

});

Route::get('/index', function () {
    return view('Public_Views.index');
})->name('index');

Route::get('/offers', function () {
    return view('Public_Views.ofertas');
});

Route::get('/contact', function () {
    return view('Public_Views.contacto');
})->name('contacto');

Route::get('/habitacion', [HabitacionController::class, 'show'])->name('habitacion');

Route::get('/habitacion2', [HabitacionController::class, 'show2'])->name('habitacion2');

Route::get('/habitacion3', [HabitacionController::class, 'show3'])->name('habitacion3');

Route::get('/hotel', function () {
    return view('Public_Views.hotel');
})->name('hotel');

require __DIR__.'/auth.php';