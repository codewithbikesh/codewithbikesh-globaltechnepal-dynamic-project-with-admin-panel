<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   public function index() {
      $products = ProductCategory::all();
  
      // Transform the products collection
      $products = $products->map(function ($product) {
          // Load the image from the file system
          $imagePath = public_path($product->image); // Assuming the image path is relative to the public directory
          if (file_exists($imagePath)) {
              // Get image file contents and encode it to Base64
              $imageData = base64_encode(file_get_contents($imagePath));
              // Get the image MIME type
              $mimeType = mime_content_type($imagePath);
              // Create a data URI scheme
              $product->image = 'data:' . $mimeType . ';base64,' . $imageData;
          }
          return $product;
      });
  
      return response()->json([
          'message' => count($products),
          'data' => $products,
          'status' => true
      ]);
  }
  
}
