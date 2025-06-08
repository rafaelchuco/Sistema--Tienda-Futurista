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

// Rutas para el recurso Producto
Route::resource('productos', ProductoController::class);