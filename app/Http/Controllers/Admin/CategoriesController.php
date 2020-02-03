<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class CategoriesController extends Controller {


    public function __construct()
    {
        $this->middleware('auth:api');
    }

    
    public function addCategory(Request $request)
    {
        $category = new Category();
        $category->name = $request->input('name');
        $category->parent_id = $request->input('parent_id');
        if ($category->save()) {
            return response()->json("The Category has been added Successfully !!");
        }
        return response()->json("Error !!");
    }


    
    public function updateCategory(Request $request)
    {
        $id= $request->input('category_id');
        $category = Category::findorfail($id);
        $category->name = $request->input('name');
        $category->parent_id = $request->input('parent_id');
        if ($category->save()) {
            return response()->json($category);
        }
        return response()->json(["msg" => "ERROR !!"]);
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $category->Delete();
        return response()->json(["msg" => "the category has been deleted !!"]);
    }


    public function getCategories()
    {
        $categories = Category::whereNull('parent_id')->with('subCategories')->get();
        return response()->json($categories);
    }


    public function getCategoryParent($id)
    {
        $subCat = Category::Find($id);
        $parentCat = $subCat->getParentCategory;

        return response()->json($parentCat);
    }

    public function getCategoryChild($id)
    {
        $parentCat = Category::find($id);
        $subCat = $parentCat->getChildCategories;
        return response()->json($subCat);
    }
    
    public function getCategorieById($id)
    {
        $Category = Category::find($id);
        return response()->json($Category,200);
    }
}
