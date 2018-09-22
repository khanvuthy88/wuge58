<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('front.home'));
});

// Home > Blog
Breadcrumbs::for('category', function ($trail,$category) {
	$category = App\Category::findOrFail($category);
    $trail->parent('home');
    if(Session::get('locale')==='en'){
    	$trail->push($category->cate_en_name, route('post.category',$category->cate_slug));
    }else{
    	$trail->push($category->cate_zh_name, route('post.category',$category->cate_slug));
    }
});

// // Home > Blog > [Category]
// Breadcrumbs::for('category', function ($trail, $category) {
//     $trail->parent('home');
//     $trail->push($category->cate_name, route('post.category', $category->id));
// });

// Home > Blog > [Category] > [Post]
Breadcrumbs::for('posts', function ($trail, $post) {
    $trail->parent('category', $post->Category->cate_slug);
    $trail->push($post->post_name, route('user.post.show', $post->post_name));
});