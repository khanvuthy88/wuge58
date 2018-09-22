<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    
    public function index()
    {
    	$categories = Cache::remember('all_category', 22*60, function () {
            return Category::all();
        });
    	return view('dashboard.category.index',compact('categories'));
    }

    public function create(Category $category)
    {
    	$category_array=array_pluck(Category::all(),'cate_name','id');
    	return view('dashboard.category._form',compact('category','category_array'));
    }

    public function store(Request $request)
    {

    	$category=new Category();
    	$category->cate_name=$request['category'];
    	$category->parent_id=$request['parent_id'];
    	$category->save();
    	$category->cate_slug=$category->id.'-'.str_slug($request['category']);
    	$category->save();

    	$categories=Category::all();
    	return redirect()->route('user.category.index',compact('categories'));
    }
}
