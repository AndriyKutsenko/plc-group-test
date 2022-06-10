<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\ModelsController;
use App\Http\Controllers\Admin\VehiclesController;
use App\Http\Controllers\Web\MainController;

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

//Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin');

        Route::get('/vehicles', [VehiclesController::class, 'index'])->name('vehicles');
        Route::get('/vehicles/add', [VehiclesController::class, 'add'])->name('vehicles-add');
        Route::post('/vehicles', [VehiclesController::class, 'create'])->name('vehicles-create');
        Route::get('/vehicles/{id}', [VehiclesController::class, 'edit'])->name('vehicles-edit');
        Route::post('/vehicles/{id}', [VehiclesController::class, 'save'])->name('vehicles-save');
        Route::get('/vehicles/delete/{id}', [VehiclesController::class, 'delete'])->name('vehicles-delete');

        Route::get('/delivery', [DeliveryController::class, 'index'])->name('delivery');
        Route::get('/delivery/add', [DeliveryController::class, 'add'])->name('delivery-add');
        Route::post('/delivery', [DeliveryController::class, 'create'])->name('delivery-create');
        Route::get('/delivery/{id}', [DeliveryController::class, 'edit'])->name('delivery-edit');
        Route::post('/delivery/{id}', [DeliveryController::class, 'save'])->name('delivery-save');
        Route::get('/delivery/delete/{id}', [DeliveryController::class, 'delete'])->name('delivery-delete');

        Route::get('/companies', [AdminController::class, 'nopage'])->name('companies');
        Route::get('/models', [AdminController::class, 'nopage'])->name('models');
        Route::post('/models-by-company', [ModelsController::class, 'getByCompany'])->name('models-by-company');
        Route::get('/fuel_types', [AdminController::class, 'nopage'])->name('fuel_types');
        Route::get('/countries', [AdminController::class, 'nopage'])->name('countries');

//        Route::get('/login', [AdminController::class, 'login'])->name('login');
    });

    Route::get('/', [MainController::class, 'index'])->name('index');
    Route::get('/detail/{id}', [MainController::class, 'detail'])->name('detail');
    Route::post('/get-delivery-cost', [MainController::class, 'delivery'])->name('get-delivery-cost');

