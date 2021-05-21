<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

//Resource controllers
use App\Http\Controllers\CrudControllers\ProductController;
use App\Http\Controllers\CrudControllers\ProductCommentController;
use App\Http\Controllers\CrudControllers\ProductImageController;
use App\Http\Controllers\CrudControllers\CustomerController;
use App\Http\Controllers\CrudControllers\InvoiceController;
use App\Http\Controllers\CrudControllers\ProductInvoiceController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');


//Crud Controller Routes
Route::resource('/products', ProductController::class);
Route::resource('/product_comment', ProductCommentController::class);
Route::resource('/product_image', ProductImageController::class);
Route::resource('/customer', CustomerController::class);
Route::resource('/invoice', InvoiceController::class);
Route::resource('/product_invoice', ProductInvoicecontroller::class);