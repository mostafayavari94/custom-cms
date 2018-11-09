<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	public $timestamps = false;

	public function user()
	{
		return $this->belongsTo('App\User','user_id');
	}
    
    public function images()
    {
        return $this->hasMany('App\PostImage','post_id');
    }

}
