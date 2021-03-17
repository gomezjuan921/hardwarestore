<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\ProveedorController;
use App\Models\Proveedor;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index']);

Route::get('inventario/entrada', [InventarioController::class, 'entradaMercancia']);
Route::get('inventario/administracion', [InventarioController::class, 'administracion']);

Route::get('categoria/desktop', [InventarioController::class, 'desktopCategoria'])->name('categoria.desktop');
Route::get('categoria/crear',   [InventarioController::class, 'crearCategoria'])->name('categoria.crear');
Route::post('categoria/almacenar', [InventarioController::class, 'almacenarCategoria'])->name('categoria.almacenar');
Route::get('categoria/detalle/{id}', [InventarioController::class, 'detalleCategoria'])->name('categoria.detalle');
Route::get('categoria/editar/{id}', [InventarioController::class, 'editarCategoria'])->name('categoria.editar');
Route::put('categoria/actualizar/{id}',[InventarioController::class, 'actualizarCategoria'])->name('categoria.actualizar');
Route::get('categoria/datatable', [InventarioController::class, 'dataCategorias'])->name('categoria.datatable');
Route::delete('categoria/eliminar/{id}', [InventarioController::class, 'eliminarCategoria'])->name('categoria.eliminar');

//Route::resource('proveedor', ProveedorController::class);
Route::get('proveedor/index', [ProveedorController::class, 'index'])->name('proveedor.index');
Route::get('proveedor/datatable', [ProveedorController::class, 'datatable'])->name('proveedor.datatable');
Route::get('proveedor/crear', [ProveedorController::class, 'crear'])->name('proveedor.crear');
Route::post('proveedor/guardar', [ProveedorController::class, 'guardar'])->name('proveedor.guardar');
Route::get('proveedor/ver/{id}', [ProveedorController::class, 'ver'])->name('proveedor.ver');
Route::get('proveedor/editar/{id}', [ProveedorController::class, 'editar'])->name('proveedor.editar');
Route::put('proveedor/actualizar/{id}',[ProveedorController::class, 'actualizar'])->name('proveedor.actualizar');
Route::delete('proveedor/eliminar/{id}', [ProveedorController::class, 'eliminar'])->name('proveedor.eliminar');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
