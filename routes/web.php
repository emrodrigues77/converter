<?php

use App\Http\Controllers\ConverterController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// grupo de rotas protegidas pelo sistema de autorização
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\ConverterController::class, 'index'])->name('home');

    Route::get('/historico', function () {
        return view('user.history');
    })->name('historico');

    Route::get('/admin', function () {
        return view('admin.index');
    })->name('admin');

    Route::get('/conversor', [App\Http\Controllers\ConverterController::class, 'index'])->name('conversor');
    Route::get('/conversao-erro', [App\Http\Controllers\ConversionController::class, 'error'])->name('conversao.erro');
    Route::post('/converter', [App\Http\Controllers\ConversionController::class, 'executeConversion'])->name('converter');
});