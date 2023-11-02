<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

     public function register(){
        $roles=Role::where('status',1)->get();
        return view('auth.register',compact('roles'));
     }
   

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function registerUser(Request $request)
    {
        $validator =Validator::make(
            $request->all(), [
            'first_name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|same:password',

        ],
        [
            'first_name.required'                 => 'First Name is required',
            'email.required'                 => 'Email is required',
            'email.unique'                 => 'Email has already been taken',
            'password.required'              => 'password is required',
            'password.min'              => 'password should contain atleast 8 characters ',
            'password_confirmation.required'              => 'password confirmation is required',
            'password_confirmation.same'              => 'password and password confirmation should match ',
            'role.required'                 => 'Please Select Role',



        ]
    );

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    $user=new User();
    $user->first_name=$request->input('first_name');
    $user->last_name=$request->input('last_name');
    $user->email=$request->input('email');
    $user->password=Hash::make($request->input('password'));
    $user->save();
    $user->assignRole($request->input('role'));
    return redirect('/')->with('success', 'User Created Successfully.');


    }
}
