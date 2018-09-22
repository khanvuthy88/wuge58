<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public function Posts()
    {
    	return $this->hasMany(Post::class);
    }
}
