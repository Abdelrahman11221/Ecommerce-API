<?php

use App\Http\Controllers\AdminAuthcontroller;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\Cartcontroller;
use App\Http\Controllers\Ordercontroller;
use App\Http\Controllers\Productcontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::group(['middleware' => 'apiauth'] , function(){

//     Route::get('product_data' , [Productcontroller::class , 'get_product']);

// });
Route::post('register' , [Authcontroller::class , 'register']);
Route::post('login' , [Authcontroller::class , 'login']);

Route::post('admin_register' , [AdminAuthcontroller::class , 'register']);
Route::post('admin_login' , [AdminAuthcontroller::class , 'login']);

Route::group(['middleware' => ['guardassign:admin-api']] , function(){
    Route::post('admin_logout' , [AdminAuthcontroller::class , 'logout']);
    Route::post('add_product' , [Productcontroller::class , 'add_product']);
    Route::post('update_product/{id}' , [Productcontroller::class , 'update_product']);
    Route::post('delete_product' , [Productcontroller::class , 'delete_product']);


});
Route::group(['middleware' => ['guardassign:user-api']] , function(){
    Route::get('product_data' , [Productcontroller::class , 'get_product']);
    Route::post('find_product' , [Productcontroller::class , 'find_product']);
    Route::post('add_cart' , [Cartcontroller::class , 'add_cart']);
    Route::get('get_cart' , [Cartcontroller::class , 'get_cart']);
    Route::post('delete_from_cart' , [Cartcontroller::class , 'delete_from_cart']);
});

Route::get('carts' , [Ordercontroller::class , 'carts']);
Route::post('check_out' , [Ordercontroller::class , 'checkout']);
