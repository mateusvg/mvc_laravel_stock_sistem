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
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellController;

Route::get('/', function () {
    $nome = "Mateus";
    $arr = [10,20,30,40,50];
    return view('welcome', ['nome' => $nome, 'arr' => $arr]);
});

Route::get('/contact', function () {
    return view('contact');
});


Route::get('/products', [ProductController::class, 'showAll'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
Route::put('/products/update/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/delete', [ProductController::class, 'delete'])->name('products.delete');

Route::get('/sell', [SellController::class, 'index'])->name('sell.index');
Route::post('/sell/add', [SellController::class, 'addToCart'])->name('sell.add');
Route::delete('/sell/delete', [SellController::class, 'deleteProduct'])->name('sell.delete');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
