<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // show the entire contact us data from database 
    // show the entire contact us data from database 
    public function index(Request $request){
        $contacts = Contact::latest();
        if(!empty($request->get('keyword'))){
            $keyword = $request->get('keyword');
            $contacts = $contacts->where('name','like','%'.$keyword.'%')
            ->orWhere('email','like','%'.$keyword.'%')
            ->orWhere('subject','like','%'.$keyword.'%')
            ->orWhere('message','like','%'.$keyword.'%');
        }
        $contacts = $contacts->paginate(5);
        return view("admin.contact.index",compact("contacts"));
    }

    // delete the contact us message to excuting the destroy method 
    // delete the contact us message to excuting the destroy method 
    public function destroy($id){
         $contacts = Contact::findOrFail($id);
         $contacts->delete();

         return redirect()->route('admin.contact.index')->with('success','Contact has been deleted successfully.');
    }


}
