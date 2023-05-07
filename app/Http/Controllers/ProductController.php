<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class ProductController extends Controller
{
    public function addproduct() 
    {
        return view('admin.addproduct');
    }

    public function products()
    {
        $categories = Category::all();
        return view('admin.products')->with('categories', $categories);
    }
    public function saveproduct(Request $request)
    {
        return view('admin.saveproduct');
    }
}
