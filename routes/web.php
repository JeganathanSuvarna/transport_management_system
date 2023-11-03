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
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'registerUser']);

Route::middleware([Authenticate::class])->group(function () {

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['controller' => 'App\Http\Controllers\RolesController'], function () {
    Route::get('permission/{id}', 'permission')->middleware('permission:Assign-Permissions');
    Route::post('permission-store/{id}', 'permissionStore');
Route::post('/roles/disable/{id}','activateRole');

});
Route::middleware(['permission:View-Role'])->group(function () {

Route::resource('/roles', App\Http\Controllers\RolesController::class);
});

Route::resource('/bus-info', App\Http\Controllers\BusInfoController::class);
Route::get('/bus-info/checkschedules/{id}', [App\Http\Controllers\BusInfoController::class,'checkSchedules']);
Route::resource('/route-info', App\Http\Controllers\RouteInfoController::class);
Route::get('/route-info/checkschedules/{id}', [App\Http\Controllers\RouteInfoController::class,'checkSchedules']);
Route::resource('/schedules', App\Http\Controllers\ScheduleController::class);
Route::get('/reports', [App\Http\Controllers\ScheduleController::class,'reports'])->middleware('permission:View-reports');
Route::post('/search', [App\Http\Controllers\ScheduleController::class,'search']);
Route::get('/reports/download', [App\Http\Controllers\ScheduleController::class,'downloadPdf'])->middleware('permission:Download-reports');
Route::resource('/users', App\Http\Controllers\UserController::class);


});
