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
    //types routs
    Route::get('/index_admin/view.create', [AdminController::class, 'viewCreate'])->name('admin.view.create');
    Route::post('/index_admin/view.save', [AdminController::class, 'viewSave'])->name('admin.view.save');
    Route::get('/index_admin/view.all', [AdminController::class, 'viewAll'])->name('admin.view.all');
    Route::delete('/index_admin/deleteType/{id}', [AdminController::class, 'deleteType'])->name('deleteType');
    Route::put('/index_admin/updateType/{id}', [AdminController::class, 'updateType'])->name('updateType');
    //category routs
    Route::get('/index_admin/categoty.create', [AdminController::class, 'categotyCreate'])->name('admin.categoty.create');
    Route::post('/index_admin/categoty.save', [AdminController::class, 'categotySave'])->name('admin.categoty.save');
    Route::get('/index_admin/categoty.all', [AdminController::class, 'categotyAll'])->name('admin.categoty.all');
    Route::put('/index_admin/updateCategoty/{id}', [AdminController::class, 'updateCategoty'])->name('updateCategoty');
    Route::delete('/index_admin/deleteCategoty/{id}', [AdminController::class, 'deleteCategoty'])->name('deleteCategoty');
    //product routs
    Route::get('/index_admin/product.create', [AdminController::class, 'productCreate'])->name('admin.product.create');
    Route::post('/index_admin/product.save', [AdminController::class, 'productSave'])->name('admin.product.save');
    Route::get('/index_admin/product.all', [AdminController::class, 'productAll'])->name('admin.product.all');
});





