<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mid;
use App\Http\Controllers\admin;
use App\Http\Controllers\admin_infeq;
use App\Http\Controllers\admin_mantenimientos;
use App\Http\Controllers\admin_settings;
use App\Http\Controllers\admin_usuarios;

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
use App\Exports\VentaExport;
use App\Exports\BajaExport;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function(){
   return view('inicio');
});

Route::get('/prueba', function(){
   return view('prueba');
});


//Crear PDF
Route::get('/crearpdf', [admin_mantenimientos::class, 'crearpdf'])->middleware('login');

//Settings
Route::get('/configuracion', [admin_settings::class, 'panel'])->middleware('login');
Route::post('/guardarcuerpo', [admin_settings::class, 'guardar_cuerpo'])->middleware('login');

//Mantenimientos
Route::get('/reportes', [admin_mantenimientos::class, 'reportes'])->middleware('login');
Route::get('/buscar', [admin_mantenimientos::class, 'buscar'])->middleware('login');
Route::get('/buscarmantenimiento', [admin_mantenimientos::class, 'buscar_mantenimientos'])->middleware('login');
Route::get('/programa', [admin_mantenimientos::class, 'programa'])->middleware('login');
Route::get('/programavalidar_year', [admin_mantenimientos::class, 'programa_validar_year'])->middleware('login');
Route::get('/estrellas', [admin_mantenimientos::class, 'obtener_estrellas'])->middleware('login');
Route::get('/cambioyear', [admin_mantenimientos::class, 'cambio_year'])->middleware('login');
Route::post('/actualizarfechas', [admin_mantenimientos::class, 'programa_actualizar_fecha'])->middleware('login');
Route::post('/actualizarfechas', [admin_mantenimientos::class, 'programa_actualizar_fecha'])->middleware('login');
Route::get('/agregarxml', [admin_mantenimientos::class, 'agregar_xmls'])->middleware('login');
Route::post('/cargaxml', [admin_mantenimientos::class, 'carga_xmls'])->middleware('login');

//InfEq
Route::get('/sirac', [admin_infeq::class, 'sirac'])->middleware('login');
Route::get('/sirac_buscar', [admin_infeq::class, 'sirac_buscar'])->middleware('login');
Route::get('/sirac_buscar_historico', [admin_infeq::class, 'sirac_buscar_historico'])->middleware('login');
Route::get('/infeq', [admin_infeq::class, 'infeq'])->middleware('login');
Route::get('/infeq_baja', [admin_infeq::class, 'infeq_baja'])->middleware('login');
Route::get('/infeqbuscar', [admin_infeq::class, 'infeq_buscar'])->middleware('login');
Route::get('/copiar_infeq', [admin_infeq::class, 'copiar_datos'])->middleware('login');
Route::get('/eliminarxid', [admin_infeq::class, 'eliminar_xid'])->middleware('login');
Route::post('/baja_economicos', [admin_infeq::class, 'baja_economicos'])->middleware('login');
Route::post('/venta_economicos', [admin_infeq::class, 'venta_economicos'])->middleware('login');
Route::get('/imprimir_baja', [admin_infeq::class, 'imprimir_baja'])->middleware('login');
Route::get('/imprimir_venta', [admin_infeq::class, 'imprimir_venta'])->middleware('login');
Route::get('/infeq_venta', [admin_infeq::class, 'venta_equipo'])->middleware('login');
Route::get('/update_obs', [admin_infeq::class, 'update_observacion'])->middleware('login');
Route::get('/update_ti_obs', [admin_infeq::class, 'update_ti_observacion'])->middleware('login');
Route::get('/infeq_sirac_obs', [admin_infeq::class, 'infeq_sirac_observacion'])->middleware('login');
Route::post('/imprimir_excel_venta', [admin_infeq::class, 'imprimir_excel_venta'])->middleware('login');
Route::post('/imprimir_excel_baja', [admin_infeq::class, 'imprimir_excel_baja'])->middleware('login');
Route::get('/imprimir_excel_venta_session', function(){
   return Excel::download(new VentaExport,  date('ymd').'_VentaDeEquipo.xlsx');
});
Route::get('/imprimir_excel_baja_session', function(){
   return Excel::download(new BajaExport, date('ymd').'_BajaDeEquipo.xlsx');
});

//Usuarios
Route::post('/insertarusuario', [admin_usuarios::class, 'insertar_usuario'])->middleware('login');
Route::get('/agregarusuario', [admin_usuarios::class, 'agregar_usuario'])->middleware('login');
Route::get('/listausuarios', [admin_usuarios::class, 'lista_usuarios'])->middleware('login');
Route::get('/actualizarusuario', [admin_usuarios::class, 'update_usuarios'])->middleware('login');
Route::get('/eliminarusuario', [admin_usuarios::class, 'delete_usuarios'])->middleware('login');

//admin
Route::post('/panel', [admin::class, 'login_validar']);
Route::get('/panel', [admin::class, 'login_view']);
Route::get('/logout', [admin::class, 'logout']);

//mid
Route::post('/insertarcomentario', [mid::class, 'insertar_comentario']);
Route::post('/validar', [mid::class, 'validacion']);
Route::get('/{mid}', [mid::class, 'id_mid']);
Route::get('/{mid}/{nip}', [mid::class, 'id_mid_nip']);

