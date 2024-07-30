<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ProductController as ApiProductController; // Corrected namespace and alias

// Uncomment and configure these routes if needed

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// Define the API route for products
Route::get('products', [ApiProductController::class, 'index']);
