<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Myproject;
use App\Http\Controllers\Mailcontroller;

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
Route::get("/home",[Myproject::class,'home']);
Route::get("/home/login",[Myproject::class,'login']);
Route::get("/home/register",[Myproject::class,'register']);
Route::post("/home/postregister",[Myproject::class,'postregister']);
Route::post("/home/postlogin",[Myproject::class,'postlogin']);
Route::get("/home/dashboard",[Myproject::class,'dashboard']);
Route::post("/home/dashboard/addtocart",[Myproject::class,'add']);
Route::get("/home/dashboard/cart",[Myproject::class,'cart']);
Route::get("/home/dashboard/checkout",[Myproject::class,'checkout']);
Route::post("/home/dashboard/order",[Myproject::class,'order']);
Route::get("/home/dashboard/profile",[Myproject::class,'profile']);
Route::get("home/dashboard/update/{id}",[Myproject::class,'update']);
Route::post("home/dashboard/updatepro",[Myproject::class,'updatepro']);
Route::delete("home/dashboard/deletecart",[Myproject::class,'deletecart']);
Route::get("/home/logout",[Myproject::class,'logout']);
//Route::get("/home/dashboard/sendsendemail",[Mailcontroller::class,'sendemail']);
Route::get("/sendemail",[Mailcontroller::class,'sendemail']);





