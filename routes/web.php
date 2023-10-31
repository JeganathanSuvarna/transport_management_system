<?php

use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Auth;
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



Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('front');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'signIn']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

Route::get('/signup', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
Route::middleware([Authenticate::class])->group(function () {

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/roles', App\Http\Controllers\RolesController::class);
Route::post('/roles/disable/{id}', [App\Http\Controllers\RolesController::class,'activateRole']);
Route::resource('/bus-info', App\Http\Controllers\BusInfoController::class);

});
