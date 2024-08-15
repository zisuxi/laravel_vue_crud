<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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

Route::get('/{pathMatch}',function(){
    return view('index');
})->where('pathMatch','.*');
Route::resource('category', CategoryController::class);
Route::post('updateCategory', [CategoryController::class, 'update']);
