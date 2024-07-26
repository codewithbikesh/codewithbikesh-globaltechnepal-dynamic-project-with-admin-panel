<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\admin\LoginController As AdminLoginController; 
use App\Http\Controllers\admin\DashboardController As AdminDashboardController; 
use App\Http\Controllers\admin\ProductController As AdminProductController; 
use App\Http\Controllers\admin\ProductDetailsController As AdminProductDetailsController; 
use App\Http\Controllers\admin\OurTeamController As AdminOurTeamController; 
use App\Http\Controllers\admin\ClientController As AdminClientController; 
use App\Http\Controllers\admin\ContactController As AdminContactController; 

use Illuminate\Support\Facades\Route;

    Route::get('/', function () {
        return view('welcome');
    });

Route::group(['prefix' => 'account'] , function(){
 
    Route::group(['middleware' =>'guest'], function(){
        Route::get('login', [LoginController::class,'index'])->name('account.login');
        Route::get('register', [LoginController::class,'register'])->name('account.register');
        Route::post('authenticate', [LoginController::class,'authenticate'])->name('account.authenticate');
        Route::post('process-register', [LoginController::class,'processRegister'])->name('account.processRegister');
    });

    Route::group(['middleware' => 'auth'], function(){
        Route::get('logout', [LoginController::class,'logout'])->name('account.logout');
        Route::get('dashboard', [DashboardController::class,'dashboard'])->name('account.dashboard');
    });
});

// For admin login page routes 
// For admin login page routes 

Route::group(['prefix' => 'admin'], function(){

Route::group(['middleware' => 'admin.guest'], function(){
// Route::get('/',[AdminLoginController::class,'index'])->name('admin.login');
Route::get('login',[AdminLoginController::class,'index'])->name('admin.login');
Route::post('authenticate',[AdminLoginController::class,'authenticate'])->name('admin.authenticate');
});

Route::group(['middleware'=> 'admin.auth'], function(){
Route::get('dashboard',[AdminDashboardController::class,'dashboard'])->name('admin.dashboard');
Route::get('logout', [AdminLoginController::class,'logout'])->name('admin.logout');

// Product Controller route from here 
Route::get('products',[AdminProductController::class,'index'])->name('admin.product.index');
Route::get('products/create',[AdminProductController::class,'create'])->name('admin.product.create');
Route::post('products/create',[AdminProductController::class,'store'])->name('admin.product.store');
Route::get('products/{id}/edit',[AdminProductController::class,'edit'])->name('admin.product.edit');
Route::put('products/{id}/edit',[AdminProductController::class,'update'])->name('admin.product.update');
Route::get('products/{id}/delete',[AdminProductController::class,'destroy'])->name('admin.product.delete');


// Product Details Route  From Here 
// Product Details Route  From Here 
Route::get('products-details',[AdminProductDetailsController::class,'index'])->name('admin.product-details.index');
Route::get('products-details/create',[AdminProductDetailsController::class,'create'])->name('admin.product-details.create');
Route::post('products-details/store',[AdminProductDetailsController::class,'store'])->name('admin.product-details.store');
Route::get('product-details/{id}/edit',[AdminProductDetailsController::class,'edit'])->name('admin.product-details.edit');
Route::put('product-details/{id}/update',[AdminProductDetailsController::class,'update'])->name('admin.product-details.update');
Route::get('product-details/{id}/delete',[AdminProductDetailsController::class,'destroy'])->name('admin.product-details.delete');


// Our Team Route is here 
// Our Team Route is here 
Route::get('our-teams',[AdminOurTeamController::class,'index'])->name('admin.our-team.index');
Route::get('our-teams/create',[AdminOurTeamController::class,'create'])->name('admin.our-team.create');
Route::post('our-teams/store',[AdminOurTeamController::class,'store'])->name('admin.our-team.store');
route::get('our-teams/{id}/edit',[AdminOurTeamController::class,'edit'])->name('admin.our-team.edit');
route::put('our-teams/{id}/update',[AdminOurTeamController::class,'update'])->name('admin.our-team.update');
route::get('our-teams/{id}/delete',[AdminOurTeamController::class,'destroy'])->name('admin.our-team.delete');


// Clients Route is here 
// Clients Route is here 
Route::get('clients',[AdminClientController::class,'index'])->name('admin.client.index');
Route::get('clients/create',[AdminClientController::class,'create'])->name('admin.client.create');
Route::post('clients/store',[AdminClientController::class,'store'])->name('admin.client.store');
Route::get ('clients/{id}/edit',[AdminClientController::class,'edit'])->name('admin.client.edit');
Route::put('clients/{id}/update',[AdminClientController::class,'update'])->name('admin.client.update');
Route::get('clients/{id}/delete',[AdminClientController::class,'destroy'])->name('admin.client.delete');

// Contact Route is here 
// Contact Route is here 
Route::get('contact',[AdminContactController::class,'index'])->name('admin.contact.index');
Route::get('contact/{id}/delete',[AdminContactController::class,'destroy'])->name('admin.contact.delete');
});

});
