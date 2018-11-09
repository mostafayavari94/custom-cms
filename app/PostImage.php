<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
	public $timestamps = false;
	
    public function post()
    {
		return $this->belongsTo('App\Post','post_id');
	}
}
