<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Clients;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index() {
        $clients = Clients::all();
    
        // Transform the products collection
        $clients = $clients->map(function ($clients) {
            // Load the image from the file system
            $imagePath = public_path($clients->image); // Assuming the image path is relative to the public directory
            if (file_exists($imagePath)) {
                // Get image file contents and encode it to Base64
                $imageData = base64_encode(file_get_contents($imagePath));
                // Get the image MIME type
                $mimeType = mime_content_type($imagePath);
                // Create a data URI scheme
                $clients->image = 'data:' . $mimeType . ';base64,' . $imageData;
            }
            return $clients;
        });
    
        return response()->json([
            'message' => count($clients),
            'data' => $clients,
            'status' => true
        ]);
    }
}
