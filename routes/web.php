<?php

use Illuminate\Support\Facades\Route;

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
    logger()->channel('telegram')->debug('1234');
    return view('welcome');
});
Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index']
);
