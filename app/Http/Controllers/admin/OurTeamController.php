<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\OurTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class OurTeamController extends Controller
{
    public function index(Request $request){
        $ourteams = OurTeam::latest();
        if(!empty($request->get('keyword'))){
            $keyword  = $request->get('keyword');
            $ourteams = $ourteams->where('name', 'like','%'.$keyword.'%')
            ->orWhere('position', 'like','%'.$keyword.'%')
            ->orWhere('linkedin', 'like','%'.$keyword.'%')
            ->orWhere('facebook', 'like','%'.$keyword.'%')
            ->orWhere('twitter', 'like','%'.$keyword.'%');
        }
        $ourteams = $ourteams->paginate(5);
         return view("admin.our-team.index",compact("ourteams"));
    }

    public function create(){
         return view("admin.our-team.create");
    }


  //  store the our team data in the database 
  //  store the our team  data in the database 
  public function store(Request $request){
    //    dd($request->all());
    $request->validate([
        'name' => 'required|max:255|string',
        'position' => 'required|max:255|string',
        'facebook' => 'required|max:255|string',
        'twitter' => 'required|max:255|string',
        'linkedin' => 'required|max:255|string',
        'image' => 'nullable|mimes:png,jpeg,gif,jpg,webp',
        'is_active' => 'sometimes',
    ]);

    $path = '';
    $filename = '';
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $path = '/uploads/our-teams/';
        $file->move(public_path($path), $filename);
    }

    OurTeam::create([
        'name' => $request->name,
        'position' => $request->position,
        'facebook' => $request->facebook,
        'twitter' => $request->twitter,
        'linkedin' => $request->linkedin,
        'image' => $path . $filename,
        'is_active' => $request->is_active ? 1 : 0,
    ]);

    return redirect()->route('admin.our-team.index')->with('success', 'Our Team added successfully');
}

// get the data from database for edit the OurTeam page
// get the data from database for edit the OurTeam page
public function edit($id){ 
    $ourteams = OurTeam::findOrFail($id);
   return view('admin.our-team.edit', compact('ourteams'));
}

//  update the data from database of ourteam page 
//  update the data from database of ourteam page 
public function update(Request $request, $id){
      //    dd($request->all());
    $request->validate([
        'name' => 'required|max:255|string',
        'position' => 'required|max:255|string',
        'facebook' => 'required|max:255|string',
        'twitter' => 'required|max:255|string',
        'linkedin' => 'required|max:255|string',
        'image' => 'nullable|mimes:png,jpeg,gif,jpg,webp',
        'is_active' => 'sometimes',
    ]);
    $ourteams = OurTeam::findOrfail($id);
    $path = '';
    $filename = '';
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $path = '/uploads/our-teams/';
        $file->move(public_path($path), $filename);
        if(File::exists(public_path($ourteams->image))){
            File::delete(public_path($ourteams->image));
         }
    }else{
        $path = $ourteams->image;
    }

    $ourteams->update([
        'name' => $request->name,
        'position' => $request->position,
        'facebook' => $request->facebook,
        'twitter' => $request->twitter,
        'linkedin' => $request->linkedin,
        'image' => $path . $filename,
        'is_active' => $request->is_active ? 1 : 0,
    ]);

    return redirect()->route('admin.our-team.index')->with('success', 'Our Team updated successfully');
}

public function destroy($id){
    $ourteams = OurTeam::findOrfail($id);
    if(File::exists(public_path($ourteams->image))){
        File::delete($ourteams->image);
    }
       $ourteams->delete();
       return redirect()->route('admin.our-team.index')->with('success','Our Team Deleted successfully');
}
}
