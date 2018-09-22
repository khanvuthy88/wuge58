<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use App\Location;
use App\User;
use Session;
use Illuminate\Support\Facades\Cache;

class FrontendController extends Controller
{
    
    public function category(Category $category)
    {

        if(Session::get('locale')==='en'){
            $title_obj=$category->cate_en_name;
        }elseif(Session::get('locale')==='zh'){
            $title_obj=$category->cate_zh_name;
        }else{
            $title_obj=$category->cate_en_name;
        }
        $categories = Cache::remember('all_category', 22*60, function () {
            return Category::all();
        });
    	$posts=Post::where('category_id',$category->id)->paginate(9);
    	return view('frontend.category',compact('posts','categories','category','title_obj'));
    }

    public function location(Location $location)
    {
        if(Session::get('locale')==='en'){
            $title_obj=$location->l_en_name;
        }elseif(Session::get('locale')==='zh'){
            $title_obj=$location->l_zh_name;
        }else{
            $title_obj=$location->l_en_name;
        }
    	$posts=Post::where('location_id',$location->id)->paginate(9);
    	$categories = Cache::remember('all_category', 22*60, function () {
            return Category::all();
        });
    	return view('frontend.category',compact('posts','categories','category','title_obj'));
    }

    public function show(Post $post)
    {
    	$title_obj=$post->post_name;
        $posts =Post::with('Category','Images','Location','User')->whereId($post->id)->get();
        $related_post=Post::where('category_id',$post->category_id)
                            ->where('id','!=',$post->id)->take(9)->get();
        $category=Category::whereId($post->category_id)->get();
        $categories = Cache::remember('all_category', 22*60, function () {
            return Category::all();
        });
        $post_auth=User::where('id',$post->id)->get();
        return view('frontend.single',compact('posts','categories','post','category','title_obj','related_post','post_auth'));
    }

    public function postByUser(User $user)
    {
        $posts=Post::where('user_id',$user->id)->paginate(9);
        $title_obj=$user->name;
        $categories = Cache::remember('all_category', 22*60, function () {
            return Category::all();
        });
        return view('frontend.category',compact('posts','categories','title_obj'));
    }
}
