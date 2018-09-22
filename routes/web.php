<?php
use Illuminate\Support\Facades\Cache;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	$posts=App\Post::latest()->paginate(9);
	$categories=Cache::remember('all_categories',22*60,function(){
		return App\Category::all();
	});
	$locations =Cache::remember('all_location',22*60,function(){
		return App\Location::all();
	});
    return view('welcome',compact('posts','categories','locations'));
})->middleware('langswicher')->name('front.home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->prefix('home')->group(function () {
	Route::get('/post/','PostController@index')->name('user.post.index');
	Route::get('/post/create','PostController@create')->name('user.post.create');
	Route::post('/post/store','PostController@store')->name('user.post.store');
	Route::patch('/post/{post}/update','PostController@update')->name('user.post.update');
	Route::get('/post/{post}/edit','PostController@edit')->name('user.post.edit');
	Route::get('/post/{post}/show','PostController@show')->name('user.post.show');

	Route::get('/post/ajax/datatable','PostController@getPostVaiAjax')->name('user.post.datatable');
});

Route::middleware(['auth'])->prefix('home')->group(function(){
	Route::get('/category/','CategoryController@index')->name('user.category.index');
	Route::get('/category/create','CategoryController@create')->name('user.category.create');
	Route::post('/category/store','CategoryController@store')->name('user.category.store');
	Route::put('/post/{post}/update','CategoryController@update')->name('user.category.update');

});

Route::post('/language/switcher/{lang?}','LanguageController@langSwitcher')->name('language.switcher');
Route::get('/post/{post}','FrontendController@show')->name('post.single');
Route::get('/category/{category}','FrontendController@category')->name('post.category');
Route::get('/location/{location}','FrontendController@location')->name('post.location');
Route::get('/user/{user}','FrontendController@postByUser')->name('post.user');
