<?php

use Illuminate\Support\Facades\Route;
//Controladores
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\AfianzadoraController;
use App\Http\Controllers\AvanceController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CodigoController;
use App\Http\Controllers\ConceptoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\OperativoController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\ContratosController;
use App\Http\Controllers\ContratosResponsableController;
use App\Http\Controllers\FianzaController;
use App\Http\Controllers\ImagenContratoController;

use App\Models\Avance;

use App\Http\Controllers\AsignarCargoController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FirmanteController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Email verificacion

Route::get('register/verify/{code}', [App\Http\Controllers\Auth\RegisterController::class,'verify'])->name('verify');

Route::group(['middleware' => ['auth']], function (){

    Route::resource('roles',RolController::class);
    Route::resource('usuarios',UsuarioController::class);
    Route::resource('empresas',EmpresaController::class);
    Route::resource('afianzadoras',AfianzadoraController::class);
    Route::resource('clientes',ClienteController::class);
    Route::resource('empleados',EmpleadoController::class);
    Route::get('empleados/{empleado}/activar',[EmpleadoController::class,'activar'])->name('empleados.activar');
    Route::resource('perfil',PerfilController::class);
    Route::resource('cargos',CargoController::class);
    Route::resource('operativos',OperativoController::class);
    
    Route::get('/pdf',[OperativoController::class,'createPDF'])->name('operativos.createPDF');
    Route::resource('unidades',UnidadController::class);
    Route::get('eliminadas',[UnidadController::class,'eliminadas'])->name('unidades.baja');
    Route::get('unidades/{id}/activar',[UnidadController::class,'activar'])->name('unidades.activas');
    Route::resource('contratos',ContratosController::class);

    Route::get('contratos/{id}/imagen',[ContratosController::class,'imagen'])->name('contratos.imagen');
    Route::post('contratos/guardar',[ContratosController::class,'guardar'])->name('contratos.guardar');
    Route::get('contratos/{imagen}/editarimagen',[ContratosController::class,'editarimagen'])->name('contratos.editarimagen');
    Route::put('contratos/{img}/actualizarimagen',[ContratosController::class,'actualizarimagen'])->name('contratos.actualizarimagen');
    
    Route::delete('contratos/{imag}/eliminarimagen',[ContratosController::class,'eliminarimagen'])->name('contratos.eliminarimagen');

    Route::get('operativo/{id}/activar',[OperativoController::class,'activar'])->name('operativo.activar');


    Route::get('contratobajas',[ContratosController::class,'eliminadas'])->name('contratos.baja');
    Route::get('contratos/{id}/activar',[ContratosController::class,'activar'])->name('contratos.activar');
    Route::resource('fianza',FianzaController::class);
    Route::get('fianza/{id}/crear',[FianzaController::class,'crear'])->name('fianza.crear');

    Route::resource('contratosR',ContratosResponsableController::class);

    Route::resource('codigos',CodigoController::class);

    Route::get('conceptos/{id}/',[CodigoController::class,'principal'])->name('codigo.principal');
    Route::get('conceptos/{id}/crear',[CodigoController::class,'crear'])->name('codigo.crear');
    
    Route::get('conceptopri/{id}/create',[ConceptoController::class,'crear'])->name('concepto.create');
   
    Route::post('codigosecundario/create',[CodigoController::class,'createsecundario'])->name('secundario.crear');
    Route::get('conceptog/{id}/crear',[CodigoController::class,'nuevoconcepto'])->name('conceptos.nuevo');
    
    Route::resource('conceptosec',ConceptoController::class);

    Route::get('conceptosec/{id}/ver',[ConceptoController::class,'ver'])->name('concepto.ver');
    //Route::get('conceptosec/{id}/imagen',[ConceptoController::class,'imagen'])->name('concepto.imagen');

    Route::get('editarsec/{concepto}/editar',[ConceptoController::class,'editarsec'])->name('concepto.edit');
    Route::post('editarsec/{concepto}/edit',[ConceptoController::class,'updatesec'])->name('secundario.update');
  
    Route::delete('eliminarsec/{concepto}/edit',[ConceptoController::class,'eliminarsec'])->name('secundario.delete');
    
    Route::get('editarsec/{concepto}/eliminados',[CodigoController::class,'eliminados'])->name('concepto.eliminados');

    Route::get('conceptosec/{concepto}/activar',[ConceptoController::class,'activar'])->name('conceptose.activar');
    Route::get('activarconceptos/{concepto}/activar',[ConceptoController::class,'secactivar'])->name('conceptosec.activar');

       
    Route::resource('Avance',AvanceController::class);

    Route::get('agregarf/{id}/fecha',[AvanceController::class,'agregarf'])->name('crearf');

    Route::post('agregarf/{id}/guardar',[AvanceController::class,'guardarf'])->name('avancef.guardar');

    Route::get('agregarf/{id}/opciones',[AvanceController::class,'agregaropc'])->name('registrar.datos');
    Route::post('agregarop/{id}/guardar',[AvanceController::class,'guardaropc'])->name('guardar.opc');
    Route::get('avancet/{id}/ver',[AvanceController::class,'veravance'])->name('ver.avance');
    
    Route::get('formulario/{id}/ver',[AvanceController::class,'formulario'])->name('registrar.avance');
    Route::get('formularioI/{id}/ver',[AvanceController::class,'formularioIzquierdo'])->name('registrar.avanceI');

    Route::post('registrarA/{id}/guardar',[AvanceController::class,'registrarAvance'])->name('registrar.Avance');
    Route::post('registrarI/{id}/guardar',[AvanceController::class,'registrarAvanceIzquierdo'])->name('registrar.AvanceIz');

    Route::get('editarHombro/{id}/concepto',[AvanceController::class,'editarIz'])->name('editar.izquierdo');


    Route::get('/avance/{id}/pdf',[AvanceController::class,'createPDF'])->name('avence.createPDF');
    Route::get('/concepto/{id}/pdf',[AvanceController::class,'create2PDF'])->name('concepto.createPDF');

    Route::get('avances/{id}/imagen',[AvanceController::class,'agregarimagenubi'])->name('avances.agregarimagenubi');

    Route::post('avances/guardarimagen',[AvanceController::class,'guardarimagen'])->name('avances.guardarimagen');

    Route::get('avances/{imagen}/editarimagen',[AvanceController::class,'editarimagen'])->name('avances.editarimagen');
    
    Route::put('avances/{img}/actualizarimagen',[AvanceController::class,'actualizarimagen'])->name('avances.actualizarimagen');

    Route::delete('avances/{imag}/eliminarimagen',[AvanceController::class,'eliminarimagen'])->name('avances.eliminarimagen');
    

    Route::resource('asignarcargo',AsignarCargoController::class);

    Route::resource('firmantes',FirmanteController::class);

    Route::get('conceptosec/{id}/imagen',[ConceptoController::class,'imagen'])->name('conceptosec.imagen');

    Route::post('conceptosec/guardarimagen',[ConceptoController::class,'guardarimagen'])->name('conceptosec.guardarimagen');

    Route::get('conceptosec/{imagen}/editarimagen',[ConceptoController::class,'editarimagen'])->name('conceptosec.editarimagen');

    Route::put('conceptosec/{img}/actualizarimagen',[ConceptoController::class,'actualizarimagen'])->name('conceptosec.actualizarimagen');

    Route::delete('conceptosec/{imag}/eliminarimagen',[ConceptoController::class,'eliminarimagen'])->name('conceptosec.eliminarimagen');

    Route::get('financiero/{id}/pdf',[ContratosController::class,'createPDF'])->name('finaciero.createPDF');

    Route::get('/avancespdf/{id}/pdf',[AvanceController::class,'createPDFAvance'])->name('avancespdf.createPDFAvance');
    
} );



  

   


Route::resource('tenant', TenantController::class);

// Contrasela de mailgun fHVp4w0CK03W*&qY
