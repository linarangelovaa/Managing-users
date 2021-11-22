<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmailConfirmController;
use App\Http\Middleware\CheckAdmin;

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
Route::get('{user}/validation', [EmailConfirmController::class, 'validation'])->name('validation')->middleware('signed');



require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {

    /*    Route::group(['middleware' => ['CheckAdmin:admin']], function () { */

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');

    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users/{user}/activate', [UserController::class, 'activate'])->name('users.activate');
    Route::get('/users/{user}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');

    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::delete('/users/{id}',        [UserController::class, 'deleteUser']);
    /*  }); */
});
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboarduser', [UserController::class, 'dashboarduser'])->name('users.dashboarduser');
});