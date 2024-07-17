<?php

use App\Http\Controllers\ImportController;
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

Route::get('viewform' , [ImportController::class , 'viewer'])->name('view_blade');
Route::post('viewform' , [ImportController::class , 'uploader'])->name('post_file');
Route::get('downloading' , [ImportController::class , 'export_data'])->name('exporting');