<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index() {
        $careers = Career::all();
    
        // Transform the products collection
        // $careers = $careers->map(function ($careers) {
        //     // Load the image from the file system
        //     $imagePath = public_path($careers->image); // Assuming the image path is relative to the public directory
        //     if (file_exists($imagePath)) {
        //         // Get image file contents and encode it to Base64
        //         $imageData = base64_encode(file_get_contents($imagePath));
        //         // Get the image MIME type
        //         $mimeType = mime_content_type($imagePath);
        //         // Create a data URI scheme
        //         $careers->image = 'data:' . $mimeType . ';base64,' . $imageData;
        //     }
        //     return $careers;
        // });
    
        return response()->json([
            'message' => count($careers),
            'data' => $careers,
            'status' => true
        ]);
    }
}
