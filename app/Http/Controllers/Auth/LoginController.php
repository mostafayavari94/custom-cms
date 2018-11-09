<?php

namespace App\Http\Controllers\Auth;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {   

        // $validator=Validator::make($request->all(),[
        //     'captcha' => 'required|captcha'
        // ],['captcha' => 'کپچا به درستی وارد نشده است.']);

        // if ($validator->fails()) {
        //     return route('login')->withErrors($validator);
        // }

$request->validate([
            'captcha' => 'required|captcha'
        ],['captcha' => 'کپچا به درستی وارد نشده است.']);


        $credentials = $request->only('email', 'password');



        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }
    }
}
