<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    
    public function Post()
    {
    	return $this->belongsTo(Post::class);
    }
}
