<?php

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


Route::get('/', [App\Http\Controllers\ProductController::class, 'view']);
Route::post('/', [App\Http\Controllers\ProductController::class, 'store'])->name('store');
Route::get('/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit']);
Route::put('/update-product/{product_id}', [App\Http\Controllers\ProductController::class, 'update']);
Route::get('/delete/{id}', [App\Http\Controllers\ProductController::class, 'destroy']);


Route::get('/add_order', [App\Http\Controllers\OrderController::class, 'view']);
Route::get('/delete_order/{id}', [App\Http\Controllers\OrderController::class, 'destroy']);
Route::post('/add_order', [App\Http\Controllers\OrderController::class, 'store'])->name('order-store');
Route::get('/edit_order/{id}', [App\Http\Controllers\OrderController::class, 'edit']);
Route::PUT('/update-order/{id}', [App\Http\Controllers\OrderController::class, 'update']);

Route::get('/invoice/{id}', [App\Http\Controllers\InvoiceController::class, 'View']);
