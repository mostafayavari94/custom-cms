<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}

    public function index()
    {
     	$list=new Category;
     	$data['list']=$list->paginate(10);
     	$data['placeholder']=Config('constants.NO_PHOTO');
    	return view('admin.categories.list',compact('data'));
    }

    public function delete($id)
    {
    	$temp=Category::find($id);
    	if ($temp!=null) {
    		$exists =Storage::exists(public_path().'/image/categories/'.$temp->image);
    		if ($exists) {
    			Storage::delete(public_path().'/image/categories/'.$temp->image);
    		}
    		$temp->delete();
    		return redirect()->action('Admin\CategoriesController@index');
    	}
    	return abort(404);
    }


    public function add(Request $request)
    {	

    	$validator=Validator::make($request->all(),
    	[
    		'name' => 'required',
    		'status' => 'required|boolean',
    		'description' => 'required',
    		'image' => 'image',
    	],[
		'required'=> 'فیلد :attribute نمیتواند خالی باشد.',
		'boolean' => 'فیلد :attribute تنها مقادیر منطقی درست و غلط را می پزیرد.',
		'image'   => 'فرمت :attribute باید از نوع تصویر باشد.',
		]);

    	if ($validator->fails()) {
    		return redirect('admin/categories')->withErrors($validator);
    	}

    	$temp=new Category;
    	$temp->name = $request->name;
        $temp->status = $request->status;
        $temp->description = $request->description;
		if($request->hasfile('image'))
        {
            $name=time().$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path().'/image/categories/', $name);  
            $temp->image = $name;  
         }
        $temp->save(['timestamps' => false]);
        return redirect()->action('Admin\CategoriesController@index');
    }


	public function detail($id)
    {

		$catregory =Category::find($id);
		return response()->json($catregory);       

	}  

    public function edit(Request $request)
    {	

    	$validator=Validator::make($request->all(),
    	[
    		'name' => 'required',
    		'status' => 'required|boolean',
    		'description' => 'required',
    		'image' => 'image',
    	],[
		'required'=> 'فیلد :attribute نمیتواند خالی باشد.',
		'boolean' => 'فیلد :attribute تنها مقادیر منطقی درست و غلط را می پزیرد.',
		'image'   => 'فرمت :attribute باید از نوع تصویر باشد.',
		]);

    	if ($validator->fails()) {
    		return redirect('admin/categories')->withErrors($validator);
    	}

    	$temp=Category::find($request->id);
    	$temp->name = $request->name;
        $temp->status = $request->status;
        $temp->description = $request->description;
		if($request->hasfile('image'))
        {
        	$exists =Storage::exists(public_path().'/image/categories/'.$temp->image);
    		if ($exists) {
    			Storage::delete(public_path().'/image/categories/'.$temp->image);
    		}
            $name=time().$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path().'/image/categories/', $name);  
            $temp->image = $name;  
         }elseif ($request->image_sts) {
         	$exists =Storage::exists(public_path().'/image/categories/'.$temp->image);
    		if ($exists) {
    			Storage::delete(public_path().'/image/categories/'.$temp->image);
    		}
    		$temp->image = 'no_photo.png';

         }
        $temp->save(['timestamps' => false]);
        return redirect()->action('Admin\CategoriesController@index');
    }

}
