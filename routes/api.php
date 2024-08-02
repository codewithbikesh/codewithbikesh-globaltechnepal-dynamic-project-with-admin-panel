<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ProductController as ApiProductController; // Corrected namespace and alias
use App\Http\Controllers\api\ProductDetailsController as ApiProductDetailsController; 
use App\Http\Controllers\api\OurTeamController as ApiOurTeamController; 
use App\Http\Controllers\api\ClientController as ApiClientController; 
use App\Http\Controllers\api\CareerController as ApiCareerController; 
use App\Http\Controllers\api\JobApplicationsController as ApiJobApplicationsController; 
use App\Http\Controllers\api\ContactController as ApiContactController; 
// Uncomment and configure these routes if needed

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// Define the API route for products
Route::get('/products', [ApiProductController::class, 'index']);
Route::get('/product-details/{id}', [ApiProductDetailsController::class, 'index']);
Route::get('/ourteams', [ApiOurTeamController::class, 'index']);
Route::get('/clients', [ApiClientController::class, 'index']);
Route::get('/careers', [ApiCareerController::class, 'index']);
Route::post('/job-applications',[ApiJobApplicationsController::class,'store']);
Route::post('/contact-us',[ApiContactController::class,'store']);

