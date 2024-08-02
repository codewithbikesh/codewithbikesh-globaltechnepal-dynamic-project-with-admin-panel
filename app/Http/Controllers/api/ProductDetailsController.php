<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\ProductDetails;
use Illuminate\Http\Request;

class ProductDetailsController extends Controller
{
    public function index($id) {
        // Find the product category by its ID
        $product = ProductCategory::findOrFail($id);
    
        // Get all ProductDetails records associated with this product category
        $productDetails = ProductDetails::where('cat_id', $id)->get();
    
        // Transform the products collection
        $productDetails = $productDetails->map(function ($productDetail) {
            // Load the image from the file system
            $imagePath = public_path($productDetail->image); // Assuming the image path is relative to the public directory
            if (file_exists($imagePath)) {
                // Get image file contents and encode it to Base64
                $imageData = base64_encode(file_get_contents($imagePath));
                // Get the image MIME type
                $mimeType = mime_content_type($imagePath);
                // Create a data URI scheme
                $productDetail->image = 'data:' . $mimeType . ';base64,' . $imageData;
            }
            return $productDetail;
        });
    
        return response()->json([
            'message' => $productDetails->count(),
            'data' => $productDetails,
            'status' => true
        ]);
    }
    
    
}
