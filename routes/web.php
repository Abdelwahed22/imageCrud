<?php

use App\Http\Controllers\StudentController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('students',[StudentController::class,'index']);
Route::get('add-student',[StudentController::class,'create']);
Route::post('add-student',[StudentController::class,'store']);
Route::get('edit-student/{id}',[StudentController::class,'edit']);
Route::put('update-student/{id}',[StudentController::class,'update']);
Route::get('delete-student/{id}',[StudentController::class,'destroy']);
