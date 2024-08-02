<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\OurTeam;
use Illuminate\Http\Request;

class OurTeamController extends Controller
{
    public function index() {
        $ourteams = OurTeam::all();
    
        // Transform the products collection
        $ourteams = $ourteams->map(function ($ourteams) {
            // Load the image from the file system
            $imagePath = public_path($ourteams->image); // Assuming the image path is relative to the public directory
            if (file_exists($imagePath)) {
                // Get image file contents and encode it to Base64
                $imageData = base64_encode(file_get_contents($imagePath));
                // Get the image MIME type
                $mimeType = mime_content_type($imagePath);
                // Create a data URI scheme
                $ourteams->image = 'data:' . $mimeType . ';base64,' . $imageData;
            }
            return $ourteams;
        });
    
        return response()->json([
            'message' => count($ourteams),
            'data' => $ourteams,
            'status' => true
        ]);
    }
}
