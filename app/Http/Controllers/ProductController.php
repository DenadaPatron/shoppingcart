<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class ProductController extends Controller
{
    public function addproduct() 
    {
        $categories = Category::All()->pluck('category_name');
        return view('admin.addproduct')->with('categories', $categories);
    }

    public function products()
    {
        
        return view('admin.products');
    }
    public function saveproduct(Request $request)
    {
        return view('admin.saveproduct');
    }
}
