<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/index_admin', [AdminController::class, 'index'])->name('index_admin');
    Route::get('/index_admin/view.create', [AdminController::class, 'viewCreate'])->name('admin.view.create');
    Route::post('/index_admin/view.save', [AdminController::class, 'viewSave'])->name('admin.view.save');
    Route::get('/index_admin/view.all', [AdminController::class, 'viewAll'])->name('admin.view.all');
    Route::delete('deleteType/{id}', [AdminController::class, 'deleteType'])->name('deleteType');
    Route::put('updateType/{id}', [AdminController::class, 'updateType'])->name('updateType');
});



