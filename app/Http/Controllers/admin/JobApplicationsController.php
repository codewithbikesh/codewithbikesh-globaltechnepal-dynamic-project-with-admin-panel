<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplications;
use Illuminate\Http\Request;

class JobApplicationsController extends Controller
{
    public function index(){
         $jobApplications = JobApplications::get();
         return view('admin.job-applications.index',compact('jobApplications'));
    }



    public function destroy($id){
        $jobApplications = JobApplications::findOrFail($id);
      // Delete the client record
        $jobApplications->delete();
    
        return redirect()->route('admin.job-applications.index')->with('success','Job Application deleted successfully');
    }
}
