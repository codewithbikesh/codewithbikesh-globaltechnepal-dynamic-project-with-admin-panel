<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request){
        // Validate the incoming request data
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:500',
            'email' => 'required|email|max:500',
            'subject' => 'required|string|max:500',
            'message' => 'required|string|max:1000',
        ]);
    
        // If validation fails, return a response with errors
        if($validation->fails()){
            return response()->json([
                'message' => 'Please fix the errors below',
                'errors' => $validation->errors(),
                'status' => false
            ], 200);
        }
    
        // Create a new Contact instance and save it to the database
        $contact = new Contact;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
    
        $contact->save();
    
        // Return a success response
        return response()->json([
            'message' => 'Your request has been submitted successfully.',
            'errors' => $validation->errors(),
            'status' => true
        ], 200);
    }
    
}
