<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // returns the 'admin.addcategory' view for adding a new category.
    public function addcategory()
    {
        return view('admin.addcategory');
    }

    // retrieves all categories and returns the 'admin.categories' view with the categories data.
    public function categories()
    {
        $categories = Category::All();
        return view('admin.categories')->with('categories', $categories);
    }

    // validates the request, creates a new Category instance, and saves it to the database.
    public function savecategory(Request $request)
    {
        $this->validate($request, ['category_name' => 'required|unique:categories']);

        $category = new Category();
        $category->category_name = $request->input('category_name');
        $category->save();

        return back()->with('status', 'Category Added Successfully');
    }

    // finds a category by its ID and returns the 'admin.edit_category' view with the category data.
    public function edit_category(Request $request, $id)
    {
        $category = Category::find($id);
        return view('admin.edit_category')->with('category', $category);
    }

    // updates the specified category's data in the database.
    public function updatecategory(Request $request)
    {
        $this->validate($request, ['category_name' => 'required']);

        $category = Category::find($request->input('id'));
        $category->category_name = $request->input('category_name');
        $category->update();

        return redirect('/categories')->with('status', 'Updated Successfully!');
    }

    // deletes a category by its ID from the database.
    public function delete_category($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect('/categories')->with('status', 'Deleted Successfully!');
    }
}

