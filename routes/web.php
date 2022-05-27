<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/register-farm', function () {
    return Inertia::render('Auth/RegisterStore', [
        'canRegister' => Route::has('register-farm'),
    ]);
});

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::group(['middleware' => ['registration_completed']], function () {
        Route::get('/dashboard', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');
    });



    Route::get('/register-farmstep2', [\App\Http\Controllers\RegisterStoreController::class, 'create'])->name('register-farm.create');
    Route::post('/register-farmstep2', [\App\Http\Controllers\RegisterStoreController::class, 'store'])->name('register-farm.store');
});


// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return Inertia::render('Dashboard');
//     })->name('dashboard');
// });
