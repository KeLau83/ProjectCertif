<?php

use App\Http\Controllers\ProgramController;
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
Route::post('/program/store', [ProgramController::class, 'store'])->name('program.store');
Route::post('/program/update/{id}', [ProgramController::class, 'update'])->name('program.update');
Route::post('/program/delete/{id}', [ProgramController::class, 'delete'])->name('program.delete');
Route::post('/program/test', [ProgramController::class, 'test'])->name('program.test');