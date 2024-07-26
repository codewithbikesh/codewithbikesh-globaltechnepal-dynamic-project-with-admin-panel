<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Clients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ClientController extends Controller
{
    // get the entire data on main index page 
    // get the entire data on main index page 
    public function index(Request $request){
        $clients = Clients::latest();
        if(!empty($request->get('keyword'))){
            $keyword = $request->get('keyword');
            $clients = $clients->where('title','like','%'.$keyword.'%');
        }
        $clients = $clients->paginate(5);
         return view("admin.client.index",compact("clients"));
    }

    // show the create page 
    // show the create page 
    public function create(){
     return view("admin.client.create");
    }

    // store the client data into database 
    // store the client data into database 
    public function store(Request $request){
        //    dd($request->all());
        $request->validate([
            'title' => 'required|max:255|string',
            'image' => 'nullable|mimes:png,jpeg,gif,jpg,webp',
            'is_active' => 'sometimes',
        ]);
    
        $path = '';
        $filename = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = '/uploads/clients/';
            $file->move(public_path($path), $filename);
        }
    
        Clients::create([
            'title' => $request->title,
            'image' => $path . $filename,
            'is_active' => $request->is_active ? 1 : 0,
        ]);
    
        return redirect()->route('admin.client.index')->with('success', 'Client added successfully');
    }

    // get data from database for edit the client page 
    // get data from database for edit the client page 
    public function edit($id){
     $clients = Clients::findOrFail($id);
     return view('admin.client.edit',compact('clients'));
    }

    // update client logo or title 
    // Update client logo or title
public function update(Request $request, $id){
    $request->validate([
        'title' => 'required|max:255|string',
        'image' => 'nullable|mimes:png,jpeg,gif,jpg,webp',
        'is_active' => 'sometimes',
    ]);

    $client = Clients::findOrFail($id);
    $path = '';
    $filename = '';

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $path = '/uploads/clients/';
        $file->move(public_path($path), $filename);

        // Delete the old image file if it exists
        $oldImage = public_path($client->image);
        if (File::exists($oldImage)) {
            File::delete($oldImage);
        }
    } else {
        // If no new file is uploaded, retain the old path
        $path = $client->image;
    }

    $client->update([
        'title' => $request->title,
        'image' => $path . $filename,
        'is_active' => $request->is_active ? 1 : 0,
    ]);

    return redirect()->route('admin.client.index')->with('success', 'Client updated successfully');
}

// Delete the client data from the database
public function destroy($id){
    $client = Clients::findOrFail($id);
    $imagePath = public_path($client->image);

    // Delete the image file if it exists
    if (File::exists($imagePath)) {
        File::delete($imagePath);
    }

    // Delete the client record
    $client->delete();

    return redirect()->route('admin.client.index')->with('success','Client deleted successfully');
}

}
