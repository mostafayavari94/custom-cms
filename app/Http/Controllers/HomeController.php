<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    // public function captchaValidate(Request $request)
    // {
    //     $request->validate([
    //         'captcha' => 'required|captcha'
    //     ]);
    // }
    public function refreshCaptcha()
    {
       
         return response()->json(['captcha'=> captcha_img()]);
    }
}
