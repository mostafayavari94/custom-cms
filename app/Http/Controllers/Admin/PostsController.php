<?php

namespace App\Http\Controllers\Admin;

use App\Post;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
	public function index()
	{	
		$temp=new Post;
		$list=DB::table('posts')->paginate(10);
		echo "<pre>";
		print_r(DB::table('posts'));
		echo "</pre>";
		die;
		return view('admin.posts_list',['list' => $list]);
	}
}
