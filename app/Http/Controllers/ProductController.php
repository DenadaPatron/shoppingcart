<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function addproduct() 
    {
        $categories = Category::All()->pluck('category_name', 'category_name');
        return view('admin.addproduct')->with('categories', $categories);
    }

    public function products()
    {   
        //view all products
        $produts = Product::All();
        //return to page with all products from Product model
        return view('admin.products')->with('products', $produts);
    }
    public function saveproduct(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'product_price' => 'required',
            'product_category' => 'required',
            'product_image' => 'image|nullable|max:1999',
        ]);

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

        $product->save();

        return back()->with('status', 'Product Added Successfully');
    }


}
