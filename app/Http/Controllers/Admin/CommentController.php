<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}
	public function index()
   {
   		$temp=new Comment;
   		$variable=$temp->paginate(10);
   		return view('admin.comments.list',compact('variable'));
   }

   public function delete($id)
   {
   		$temp=Comment::find($id);
   		$temp->delete();
   		return redirect()->action('Admin\CommentController@index')->with('success','نظر با موفقیت حدف شد.');
   }

   public function detail($id)
   {

		$catregory =Comment::find($id);
		return response()->json($catregory);       

	}

   public function confirm(Request $request)
   {
      $temp=Comment::find($request->id);
      $temp->status=1;
      $temp->save(['timestamps' => false]);
      return ("نظر با موفقیت تاید شد.");
   }

   public function page()
   {
      $temp=new Comment;
      $variable=$temp->paginate(10);
      return view('admin.comments.page',compact('variable'));
   }
}
