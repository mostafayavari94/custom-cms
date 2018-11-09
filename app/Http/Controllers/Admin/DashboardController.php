<?php

namespace App\Http\Controllers\Admin;
use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    public function noti()
    {
        $temp=Comment::where('status',0)->count();
        return response()->json($temp);
    }

    
}
