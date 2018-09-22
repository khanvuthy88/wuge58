<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    
    public function User()
    {
    	return $this->belongsTo(User::class);
    }

    public function Category()
    {
    	return $this->belongsTo(Category::class);
    }

    public function Location()
    {
    	return $this->belongsTo(Location::class);
    }

    public function Images()
    {
    	return $this->hasMany(Image::class);
    }
}
