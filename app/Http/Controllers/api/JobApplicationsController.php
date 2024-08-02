<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\JobApplications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobApplicationsController extends Controller
{
       // create api store data into database 
    // create api store data into database 
    public function store(Request $request){
        $validation =  Validator::make( $request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'career_id' => 'nullable|exists:careers,id',
            'mobile_number' => 'required|numeric',
            'address' => 'required|string|max:1000',
            'cover_letter' => 'required|string|max:500',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
         ]);
         if($validation->fails()){
              return response()->json([
                 'message' => 'Masum bikesh pahele error ko fix karo',
                 'errors' => $validation->errors(),
                 'status' => false
              ],200);
         }
         $path = '';
         $filename = '';
         if ($request->hasFile('resume')) {
             $file = $request->file('resume');
             $extension = $file->getClientOriginalExtension();
             $filename = time() . '.' . $extension;
             $path = '/uploads/resumes/';
             $file->move(public_path($path), $filename);
         }

          $jobApplications = new JobApplications;
          $jobApplications->name = $request->name;
          $jobApplications->email = $request->email;
          $jobApplications->career_id = $request->career_id;
          $jobApplications->mobile_number = $request->mobile_number;
          $jobApplications->address = $request->address;
          $jobApplications->cover_letter = $request->cover_letter;
          $jobApplications->resume = $path . $filename;
          $jobApplications->save();
 
          return response()->json([
             'message' => 'application submited successfully',
             'errors' => $validation->errors(),
             'status' => true
          ],200);
 
     }
}
