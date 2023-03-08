<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;

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

//home route

Route::get('/home', [HomeController::class, 'index'])->name('home');

//roles,users,products routes

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::get('export', [ProductController::class, 'export'])->name('export');
    Route::post('import', [ProductController::class, 'import'])->name('import');
});

//import export route
/*
Route::get('export', [ProductController::class, 'export'])->name('export');
Route::post('import', [ProductController::class, 'import'])->name('import');*/

