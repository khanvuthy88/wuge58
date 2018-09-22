<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Category;
use App\Location;
use App\Image;
use Carbon\Carbon;
use Image as InventionImage;
use Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Cache;


class PostController extends Controller
{
    public function index()
    {
    	$posts=Post::where('user_id',Auth::id())->get();
    	return view('dashboard.post.index',compact('posts'));
    }

    public function create(Post $post)
    {
    	$categoriesArray = Cache::remember('all_category', 22*60, function () {
            return Category::all();
        });
        $locations = Cache::remember('all_location', 22*60, function () {
            return Location::all();
        });
    	return view('dashboard.post._form',compact('categoriesArray','post','locations'));
    }

    public function store(Request $request)
    {
    	$files=$request['gallery_images'];
        if (count($files)>8) {
            return back();
        }

    	$post=new Post();
    	$post->post_name=$request['post_name'];
    	$post->status=$request['condition'];
    	$post->price=$request['price'];
    	$post->post_description=$request['post_description'];
    	$time = Carbon::now();
    	if ($request->file('feature_image')) {
    		$feature_image=$request['feature_image'];
    		$ext=$feature_image->guessClientExtension();
            $imageName=str_random(5).date_format($time,'d').date_format($time,'m').'_user_'.Auth::id().'_product_'.str_slug($request['post_name']).".".$ext;
            $image_full='images/'.$imageName;
            // perform some modifications
            $image_feature_300='images/image_thumb_300_'.$imageName;
            InventionImage::make($feature_image->getRealPath())->resize(null,240, function ($constraint) {
                $constraint->aspectRatio();
            })->save($image_feature_300);  
            $post->feature_image=$image_feature_300;
    	}
    	$post->save();
    	$post->post_slug=$post->id.'-'.str_slug($post->post_name);
    	$post->save();
    	$post->User()->associate(Auth::id());
    	$post->save();
    	$post->Category()->associate($request['category']);
    	$post->save();
    	$post->Location()->associate($request['location']);
    	$post->save();

    	if($files){
            foreach($files as $file){                
                $image_obj=new Image();
                $ext = $file->guessClientExtension();
                $imageName = str_random(5).date_format($time,'d').date_format($time,'m').'_user_'.Auth::id().'_product_'.str_slug($request['name']).".".$ext;


                $image_thumb_300='images/image_thumb_300_'.$imageName;
                $image_full_url='images/'.$imageName;
                $img=InventionImage::make($file->getRealPath())->save($image_full_url);
                $img->backup();

                // perform some modifications
                $img->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($image_thumb_300);

                // reset image (return to backup state)
                $img->reset();

                $image_obj->name=$file->getClientOriginalName();
                $image_obj->thumbnail=$image_thumb_300;
                $image_obj->full_url=$image_full_url;

                $image_obj->Post()->associate($post);
                $image_obj->save();
                // $post->Images()->associate($image_obj);
            }
        }
        $posts=Post::where('user_id',Auth::id())->get();
        return redirect()->route('user.post.index',compact('posts'));
    }

    public function edit(Post $post)
    {
        $categoriesArray = Cache::remember('all_category', 22*60, function () {
            return Category::all();
        });
        $locations = Cache::remember('all_location', 22*60, function () {
            return Location::all();
        });
        return view('dashboard.post._form',compact('categoriesArray','post','locations'));
    }

    public function update(Request $request, Post $post)
    {
        $files=$request['gallery_images'];
        $post->post_name=$request['post_name'];
        $post->status=$request['condition'];
        $post->price=$request['price'];
        $post->post_description=$request['post_description'];
        $time = Carbon::now();
        if ($request->file('feature_image')) {
            $feature_image=$request['feature_image'];
            $ext=$feature_image->guessClientExtension();
            $imageName=str_random(5).date_format($time,'d').date_format($time,'m').'_user_'.Auth::id().'_product_'.str_slug($request['post_name']).".".$ext;
            $image_full='images/'.$imageName;
            // perform some modifications
            $image_feature_300='images/image_feature_300_'.$imageName;
            InventionImage::make($feature_image->getRealPath())->resize(null,240, function ($constraint) {
                $constraint->aspectRatio();
            })->save($image_feature_300);  
            $post->feature_image=$image_feature_300;
        }
        $post->save();
        $post->post_slug=$post->id.'-'.str_slug($request['post_name']);
        $post->save();
        $post->User()->associate(Auth::id());
        $post->save();
        $post->Category()->associate($request['category']);
        $post->save();
        $post->Location()->associate($request['location']);
        $post->save();

        if(isset($files)){

            Image::where('post_id', $post->id)->delete();

            foreach($files as $file){

                $image_obj=new Image();
                $ext = $file->guessClientExtension();
                $imageName = str_random(5).date_format($time,'d').date_format($time,'m').'_user_'.Auth::id().'_product_'.str_slug($request['name']).".".$ext;

                $image_thumb_300='images/'.'image_thumb_300_'.$imageName;
                $image_full='images/'.$imageName;
                $img=InventionImage::make($file->getRealPath())->save($image_full);
                $img->backup();

                // perform some modifications
                $img->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($image_thumb_300);

                // reset image (return to backup state)
                $img->reset();

                $image_obj->name=$file->getClientOriginalName();
                $image_obj->thumbnail=$image_thumb_300;
                $image_obj->full_url=$image_full;

                $image_obj->Post()->associate($post);
                $image_obj->save();
                // $post->Images()->associate($image_obj);
            }
        }
        $posts=Post::where('user_id',Auth::id())->get();
        return redirect()->route('user.post.index',compact('posts'));
    }

    public function show(Post $post)
    {
        $posts =Post::with('Category','Images','Location','User')->whereId($post->id)->get();
        $category=Category::whereId($post->category_id)->get();
        $categories=Category::all();
        return view('frontend.single',compact('posts','categories','post','category'));
    }

    public function getPostVaiAjax()
    {
        $posts=Post::where('user_id',Auth::id())->get();
        return Datatables::of($posts)
            ->addColumn('action', function ($user) {
                return '<div class="btn-group float-right" role="group" aria-label="'.__('login.form_action_label').'">
                    <a href="'.route('user.post.edit',$user->post_slug).'" class="btn btn-xs btn-warning">'.__('login.edit').'</a>
                    <a href="'.route('user.post.edit',$user->post_slug).'" class="btn btn-xs btn-danger">'.__('login.delete').'</a>
                    <a href="'.route('post.single',$user->post_slug).'" class="btn btn-xs btn-primary">'.__('login.show').'</a>
                </div>';

            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make();
    }
}


