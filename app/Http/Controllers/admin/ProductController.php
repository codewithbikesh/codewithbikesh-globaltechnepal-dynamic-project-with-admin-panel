<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

  // show the product category list page 
  // show the product category list page 
    public function index(Request $request){
      $products = ProductCategory::latest();
      if(!empty($request->get('keyword'))){
        $keyword  = $request->get('keyword');
        $products = $products->where('name', 'like','%'.$keyword.'%')
        ->orWhere('description', 'like','%'.$keyword.'%');
       }
      $products = $products->paginate(5);
         return view("admin.product.index",compact("products"));
    }

    // show the  product category create page 
    // show the  product category create page 
    public function create(){
        return view("admin.product.create");
   }


  //  store the product category in the database 
  //  store the product category in the database 
   public function store(Request $request){
    $request->validate([
        'name' => 'required|max:255|string',
        'description' => 'required|max:2000',
        'image' => 'nullable|mimes:png,jpeg,gif,jpg,webp',
        'is_active' => 'sometimes',
    ]);
    
    $path = '';
    $filename = '';
    if($request->hasFile('image')){
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $path = '/uploads/products/';
        $file->move(public_path($path), $filename);
       }

     ProductCategory::create([
       'name' => $request->name,
       'description' => $request->description,
       'image' => $path.$filename,
       'is_active' => $request->is_active == true ?  1:0,

     ]);
     return redirect()->route('admin.product.index')->with('success','Products Category Added successfully');
   }

      // get the data from database for the edit 
    // get the data from database for the edit 
    public function edit($id){
      $product = ProductCategory::findOrFail($id);
      return view('admin.product.edit',compact('product'));
  }

    // update the data from database for the product category
    // update the data from database for the product category
    public function update(Request $request, $id){
      $request->validate([
          'name' => 'required|max:255|string',
          'description' => 'required|max:255|string',
          'image' => 'nullable|mimes:png,jpeg,gif,jpg,webp',
          'is_active' => 'sometimes',
      ]);

      $product = ProductCategory::findOrfail($id);
      $path = '';
      $filename = '';
      if($request->hasFile('image')){
          $file = $request->file('image');
          $extension = $file->getClientOriginalExtension();
          $filename = time().'.'.$extension;
          $path = '/uploads/products/';
          $file->move(public_path($path), $filename);

          if(File::exists(public_path($product->image))){
             File::delete(public_path($product->image));
          }
         }else{
        $path = $product->image;
         }

         $product->update([
          'name' => $request->name,
          'description' => $request->description,
          'image' => $path.$filename,
          'is_active' => $request->is_active == true ?  1:0,
      ]);
      return redirect()->route('admin.product.index')->with('success','Products Category Updated successfully');
  }

  // Delete the data from database 
  public function destroy($id){
    $product = ProductCategory::findOrFail($id);
   if(File::exists(public_path($product->image))){
    File::delete($product->image);
   }
    $product->delete();
    return redirect()->route('admin.product.index')->with('success','Products Category Deleted successfully');
}
}
