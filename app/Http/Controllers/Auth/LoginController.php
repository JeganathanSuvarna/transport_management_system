<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    public function login(){
        return view('auth.login');
    }
    public function signIn(Request $request)
    {
        
        $validator = Validator::make(
            $request->all(),
            [
                'email'                 => 'required|email|max:255',
                'password'              => 'required',
            ],
            [
                'email.required'                 => 'Email is required',
                'password.required'              => 'password is required',
            ]

        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $input = $request->all();
        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return redirect('/')->with('error', 'Sorry you are not a member of this system');
        }        
        elseif (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
                $user=auth()->user();
                return redirect('/dashboard');
        
            } 
         else {


            return redirect('/')->with('error', 'Email or password is wrong');
        }
}
public function logout()
{
    Auth::logout();
    return redirect('/');
}
}
