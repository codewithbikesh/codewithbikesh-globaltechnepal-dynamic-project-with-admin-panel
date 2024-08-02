<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\JobApplications;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    // show the list of data in table 
    // show the list of data in table 
        public function index(Request $request){
            $careers = Career::where('is_active', 1)->latest();
            $inactiveCareers = Career::where('is_active', 0)->get(); 
            if(!empty($request->get('keyword'))){
                $keyword  = $request->get('keyword');
                $careers = $careers->where('jobCategory', 'like','%'.$keyword.'%')
                ->orWhere('position', 'like','%'.$keyword.'%')
                ->orWhere('totalPositions', 'like','%'.$keyword.'%')
                ->orWhere('qualification', 'like','%'.$keyword.'%')
                ->orWhere('experience', 'like','%'.$keyword.'%')
                ->orWhere('gender', 'like','%'.$keyword.'%')
                ->orWhere('lastDate', 'like','%'.$keyword.'%')
                ->orWhere('description', 'like','%'.$keyword.'%');
            }
            $careers = $careers->paginate(5);
            return view("admin.career.index",compact('careers','inactiveCareers'));
        }

    // create new career apportunative 
    // create new career apportunative 
    public function create(){
        return view("admin.career.create");
    }

    // store career data into database 
    // store career data into database 
    public function store(Request $request){
        $request->validate([
            'jobcategory' => 'required|max:255|string',
            'position' => 'required|max:255|string',
            'vacancies' => 'required|max:255|string',
            'qualification' => 'required|max:255|string',
            'experience' => 'required|max:255|string',
            'gender' => 'required|max:255|string',
            'last_date' => 'required|max:255|string',
            'description' => 'required|max:2000',
            'is_active' => 'sometimes',
        ]);

        Career::create([
            'jobCategory' => $request->jobcategory,
            'position' => $request->position,
            'totalPositions' => $request->vacancies,
            'qualification' => $request->qualification,
            'experience' => $request->experience,
            'gender' => $request->gender,
            'lastDate' => $request->last_date,
            'description' => $request->description,
            'is_active' => $request->is_active == true ?  1:0,
     
          ]);
          return redirect()->route('admin.career.index')->with('success','Career Added successfully');
    }

    // get the data from database for edit 
    // get the data from database for edit 
    public function edit($id){
        $careers = Career::findOrFail($id);
        return view('admin.career.edit',compact('careers'));
    }

    // update the career data from database
    // update the career data from database
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'jobcategory' => 'required|max:255|string',
            'position' => 'required|max:255|string',
            'vacancies' => 'required|integer',
            'qualification' => 'required|max:255|string',
            'experience' => 'required|max:255|string',
            'gender' => 'required|max:255|string',
            'last_date' => 'required|date',
            'description' => 'required|max:2000',
            'is_active' => 'sometimes',
        ]);
    
        // Find the Career record by ID
        $careers = Career::findOrFail($id);
    
        // Update the Career record
        $careers->update([
            'jobCategory' => $request->jobcategory,
            'position' => $request->position,
            'totalPositions' => $request->vacancies,
            'qualification' => $request->qualification,
            'experience' => $request->experience,
            'gender' => $request->gender,
            'lastDate' => $request->last_date,
            'description' => $request->description,
            'is_active' => $request->is_active == true ? 1 : 0,
        ]);
    
        // Redirect back with success message
        return redirect()->route('admin.career.index')->with('success', 'Career updated successfully');
    }
    
    // Detele the career information from the database through this code 
    // Detele the career information from the database through this code 
    // public function destroy($id){
    //     $careers = Career::findOrFail($id);
    //     $careers->delete();
    //     return redirect()->route('admin.career.index')->with('success','Career deleted successfully.');
    // }

    public function destroy($id) {
        // Find the careers category by its ID
        $career = Career::findOrFail($id);
        
        // Check if there are any jobApplications records associated with this product category
        $jobApplications = JobApplications::where('career_id', $id)->first();
      
        // If there are associated ProductDetails records, do not delete the product category
        if ($jobApplications) {
            return redirect()->route('admin.career.index')->with('error', 'Cannot delete Career. There are associated Job Applications.');
        }
        
        // Delete the product category
        $career->delete();
      
        // Redirect with success message
        return redirect()->route('admin.career.index')->with('success', 'Career deleted successfully');
      }
      
    
    // detele the career information if the given date has been expired 
    // detele the career information if the given date has been expired 
    // public function deleteExpiredRecords()
    // {
    //     Career::deleteRecordsWithCurrentDate();
    //     return response()->json(['message' => 'Expired records deleted successfully.']);
    // }

}
