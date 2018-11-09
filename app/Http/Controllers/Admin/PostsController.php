<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\PostImage;
use Auth;
use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{

	public function __construct(){

		$this->middleware('auth');
	}

	public function index()
	{	
		$temp=new Post;
		$list=$temp::with('user')->paginate(10);
		return view('admin.posts.list',['list' => $list]);
	}


	public function delete($id)
    {
		$temp= Post::find($id);
		if($temp!=null){
			$temp->image()->delete();
			$temp->delete();
			return redirect()->action('Admin\PostsController@index')->with('success','مطلب با موفقیت حدف شد.');
		}
		return abort(404);
	}

	public function detail($id)
    {
		$temp= Post::find($id);
		if($temp!=null){
			$variables['placeholder'] = Config('constants.NO_PHOTO');
			$variables['entity'] = $temp;
			return view("admin.posts.edit",compact('variables'));
		}
		abort(404);
	}

	public function addPage()
    {
		$variables  = array('placeholder' => Config('constants.NO_PHOTO'), );
		return view("admin.posts.add",compact('variables'));
	}


	public function addForm(Request $request)
    {	
    	ini_set('memory_limit','256M');
    	$validator=Validator::make($request->all(),
    	[
    		'title' => 'required',
    		'status' => 'required|boolean',
    		'text' => 'required',
    		'abstract' => 'required',
    		'main_image' => 'image',
    		'pics\*' => 'image|max:2048',
    	],[
		'required'=> 'فیلد :attribute نمیتواند خالی باشد.',
		'boolean' => 'فیلد :attribute تنها مقادیر منطقی درست و غلط را می پزیرد.',
		'image'   => 'فرمت :attribute باید از نوع تصویر باشد.',
		'max'     => 'عکس های انتخابی نباید از ۲ مگابایت بیشتر باشند.',
		]);

    	if ($validator->fails()) {
    		return redirect()->action('Admin\PostsController@addPage')->withErrors($validator);
    	}

    	$temp=new Post;
    	$temp->title = $request->title;
        $temp->text = $request->text;
        $temp->abstract = $request->abstract;
        $temp->status = $request->status;
        $temp->user_id = Auth::user()->id;
		if($request->hasfile('main_image'))
        {
            $name=time().$request->file('main_image')->getClientOriginalName();
            $request->file('main_image')->move(public_path().'/image/posts/', $name);  
            $temp->image = $name;
        }else{
        	$temp->image="posts/no_photo.png";
        }
        $temp->save(['timestamps' => false]);
        $id = $temp->id;


		if($request->hasfile('pics'))
        {
        	foreach($request->file('pics') as $file)
            {
				$temp=new PostImage;
	            $name=time().$file->getClientOriginalName();
	            $file->move(public_path().'/image/posts/', $name);  
	            $temp->link = $name;
	            $temp->post_id = $id;
        		$temp->save(['timestamps' => false]);
            
            }
        }

        return redirect()->action('Admin\PostsController@index')->with('success', 'مطلب با موفقیت ثبت شد.');
    }

    public function edit(Request $request)
    {	
    	ini_set('memory_limit','256M');
    	$validator=Validator::make($request->all(),
    	[
    		'title' => 'required',
    		'status' => 'required|boolean',
    		'text' => 'required',
    		'abstract' => 'required',
    		'main_image' => 'image',
    		'pics\*' => 'image|max:2048',
    	],[
		'required'=> 'فیلد :attribute نمیتواند خالی باشد.',
		'boolean' => 'فیلد :attribute تنها مقادیر منطقی درست و غلط را می پزیرد.',
		'image'   => 'فرمت :attribute باید از نوع تصویر باشد.',
		'max'     => 'عکس های انتخابی نباید از ۲ مگابایت بیشتر باشند.',
		]);

    	if ($validator->fails()) {
    		return redirect()->action('Admin\PostsController@detail')->withErrors($validator);
    	}

    	$temp=Post::find($request->id);
    	$temp->title = $request->title;
        $temp->text = $request->text;
        $temp->abstract = $request->abstract;
        $temp->status = $request->status;
		if($request->hasfile('main_image'))
        {
        	$exists =Storage::exists(public_path().'/image/posts/'.$temp->image);
    		if ($exists) {
    			Storage::delete(public_path().'/image/posts/'.$temp->image);
    		}
            $name=time().$request->file('main_image')->getClientOriginalName();
            $request->file('main_image')->move(public_path().'/image/posts/', $name);  
            $temp->image = $name;
        }elseif($request->image_status){
        	$temp->image="posts/no_photo.png";
        }
        $temp->save(['timestamps' => false]);
        
        if(isset($request->old_images)) {
        	foreach ($temp->images as $key => $value) {
        		if (!in_array($value->id, $request->old_images)) {
        			$temp= PostImage::find($value->id);
        			$exists =Storage::exists(public_path().'/image/posts/'.$temp->link);
		    		if ($exists) {
		    			Storage::delete(public_path().'/image/posts/'.$temp->link);
		    		}
        			$temp->delete();
        		}
        	}
        }

		if($request->hasfile('pics'))
        {
        	foreach($request->file('pics') as $file)
            {
				$temp=new PostImage;
	            $name=time().$file->getClientOriginalName();
	            $file->move(public_path().'/image/posts/', $name);  
	            $temp->link = $name;
	            $temp->post_id = $request->id;
        		$temp->save(['timestamps' => false]);
            
            }
        }

        return redirect()->action('Admin\PostsController@index')->with('success', 'مطلب با موفقیت ثبت شد.');
    }

	

}
