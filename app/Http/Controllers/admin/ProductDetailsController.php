<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\ProductDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductDetailsController extends Controller
{
    public function index(Request $request){
        $productDetails = ProductDetails::latest();
       if(!empty($request->get('keyword'))){
          $keyword = $request->get('keyword');
          $productDetails = $productDetails->where('name','like','%'.$keyword.'%')
          ->orWhere('description','like','%'.$keyword.'%');
          
       }


        $productDetails = $productDetails->paginate(5);
         return view("admin.product-details.index",compact("productDetails"));
    }

    public function create(){
        $products = ProductCategory::get();
        return view("admin.product-details.create",compact("products"));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:255|string',
            'description' => 'required|max:255|string',
            'cat_id'=>'nullable|exists:products,id',
            'image' => 'nullable|mimes:png,jpeg,gif,jpg,webp',
            'is_active' => 'sometimes',
        ]);
        
        $path = '';
        $filename = '';
        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $path = '/uploads/product-details/';
            $file->move(public_path($path), $filename);
           }
    
         ProductDetails::create([
           'name' => $request->name,
           'description' => $request->description,
           'cat_id' => $request->cat_id,
           'image' => $path.$filename,
           'is_active' => $request->is_active == true ?  1:0,
    
         ]);
         return redirect()->route('admin.product-details.index')->with('success','Product Details Added successfully');
    }

    // show the data in edit page from database 
    // show the data in edit page from database 
    public function edit($id){
         $productDetails = ProductDetails::findOrFail($id);
         $products = ProductCategory::get();
         return view("admin.product-details.edit",compact("productDetails","products"));
    }

    // update the data from database 
    // update the data from database 
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|max:255|string',
            'description' => 'required|max:255|string',
            'cat_id'=>'nullable|exists:products,id',
            'image' => 'nullable|mimes:png,jpeg,gif,jpg,webp',
            'is_active' => 'sometimes',
        ]);
  
        $product = ProductDetails::findOrfail($id);
        $path = '';
        $filename = '';
        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $path = '/uploads/product-details/';
            $file->move(public_path($path), $filename);
  
            if(File::exists(public_path($product->image))){
               File::delete(public_path($product->image));
            }
           }else {
            // If no new file is uploaded, retain the old path
            $path = $product->image;
        }
  
           $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'cat_id' => $request->cat_id,
            'image' => $path.$filename,
            'is_active' => $request->is_active == true ?  1:0,
        ]);
        return redirect()->route('admin.product-details.index')->with('success','Product Details Updated successfully');
    }

    //    Delete the product details from database 
    //    Delete the product details from database 
    
  // Delete the data from database 
  public function destroy($id){
    $product = ProductDetails::findOrFail($id);
   if(File::exists(public_path($product->image))){
    File::delete($product->image);
   }
    $product->delete();
    return redirect()->route('admin.product-details.index')->with('success','Product Details Deleted successfully');
}
}
