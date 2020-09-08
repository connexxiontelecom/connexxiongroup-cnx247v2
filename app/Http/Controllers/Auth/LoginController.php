<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /*
    * Show login form
    */
    public function signin(){
        return view('auth.login');
    }

    /*
    * Show reset password form
    */
    public function showResetPasswordForm(){
        return view('auth.passwords.reset');
    }

    /*
    * Set password
    */
    public function setPassword($token){
        $email = DB::table('password_resets')->where('token', $token);
        if(!empty($email)){
            return view('auth.passwords.confirm');
        }else{
            return redirect()->route('404');
        }
    }
}
