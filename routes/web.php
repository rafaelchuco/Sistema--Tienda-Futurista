<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Ruta principal - redirige a la lista de productos
Route::get('/', function () {
    return redirect('/productos');
});

// Rutas específicas para Query Builder (deben ir ANTES de Route::resource)
Route::get('/productos/search', [ProductoController::class, 'list'])
    ->name('productos.list');
Route::post('/productos/search', [ProductoController::class, 'search'])
    ->name('productos.search');

// Rutas para el recurso Producto (mantiene las rutas RESTful existentes)
Route::resource('productos', ProductoController::class);