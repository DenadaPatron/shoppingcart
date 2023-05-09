<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    //returns the 'admin.products' view with all products data.
    public function products()
    {   
        //view all products
        //only show products with status = 1
        $produts = Product::All();
        //where('status', 1)
        //return to page with all products from Product model
        return view('admin.products')->with('products', $produts);
    }


    //returns the 'admin.addproduct' view with all categories data.
    public function addproduct() 
    {
        $categories = Category::All()->pluck('category_name', 'category_name');
        return view('admin.addproduct')->with('categories', $categories);
    }


    //saves the product data to the database.
    public function saveproduct(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'product_price' => 'required',
            'product_category' => 'required',
            'product_image' => 'image|nullable|max:1999',]);

        if($request->hasfile('product_image')){
            //get filename with extension
            $filenameWithExt = $request->file('product_image')->getClientOriginalName();
            //get just filename
            $fileName = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            
            //get just file extension
            $extension = $request->file('product_image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;

            //upload image
            $path = $request->file('product_image')->storeAs('public/product_images', $fileNameToStore);
        }
        else{
            $fileNameToStore = 'noimage.jpg';
        }

        $product = new Product();
        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        $product->product_category = $request->input('product_category');
        $product->product_image = $fileNameToStore;
        //equals to 1 for the purpose of deactivation
        $product->status = 1;

        $product->save();

        return back()->with('status', 'Product Added Successfully');
    }
    //edits product from already existing ones
    public function edit_product($id){
        $product = Product::find($id);
        $categories = Category::All()->pluck('category_name', 'category_name');
        return view('admin.editproduct')->with('product', $product)->with('categories', $categories);

    }
    //confirms validation
    public function updateproduct(Request $request){

        $this->validate($request, [
                            'product_name' => 'required',
                            'product_price' => 'required',
                            'product_category' => 'required',
                            'product_image' => 'image|nullable|max:1999']);


        $product = Product::find($request->input('id'));
        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        $product->product_category = $request->input('product_category');

        if($request->hasfile('product_image')){
            //get filename with extension
            $filenameWithExt = $request->file('product_image')->getClientOriginalName();
            //get just filename
            $fileName = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            
            //get just file extension
            $extension = $request->file('product_image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;

            //upload image
            $path = $request->file('product_image')->storeAs('public/product_images', $fileNameToStore);

            if($product->product_image != 'noimage.jpg'){
                Storage::delete('public/product_images/'.$product->product_image);
            }

            $product->product_image = $fileNameToStore;

        }
        

        $product->update();

        return redirect('/products')->with('status', 'Product updated successfully!');
    }
    //deletes product and deletes image from storage if image is not noimage.jpg   
    public function delete_product($id){
        $product =  Product::find($id);

        if($product->product_image != 'noimage.jpg'){
            Storage::delete('public/product_images/'.$product->product_image);
        }

        $product -> delete();

        return back()->with('status', 'Product has been removed successfully!');
    }
    //activates product by changing status to 1
    public function activate_product($id){
        $product = Product::find($id);

        $product->status = 1;
        $product->update();
        return back()->with('status', 'Product has been activated successfully!');
    }
    //deactivates product by changing status to 0
    public function deactivate_product($id){
        $product = Product::find($id);

        $product->status = 0;
        $product->update();
        return back()->with('status', 'Product has been deactivated uccessfully!');
    }
    //returns the 'client.shop' view with all products data based on category.
    public function view_product_by_category($category_name){

        $products = Product::All()->where('product_category', $category_name)->where('status', 1);
        $categories = Category::All();
        return view('client.shop')->with('products', $products)->with('categories', $categories);
    }


}
