<?php

namespace App\Http\Controllers;

use App\Models\user;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::where('status',1)->get();
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        return redirect('/users')->with('success', 'User Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::find($id);
        $roles=Role::where('status',1)->get();
        return view('users.edit',compact('roles','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator =Validator::make(
            $request->all(), [
            'first_name' => 'required|max:255',
            'email' => 'required',
            'role' => 'required',

        ],
        [
            'first_name.required'                 => 'First Name is required',
            'email.required'                 => 'Email is required',
            'role.required'                 => 'Please Select Role',
        ]
    );

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    $user=User::find($id);
    $user->first_name=$request->input('first_name');
    $user->last_name=$request->input('last_name');
    $user->email=$request->input('email');
    $user->password=Hash::make($request->input('password'));
    $user->save();
    $user->removeRole($user->getRoleNames()[0]);
    $user->assignRole($request->input('role'));
    return redirect('/users')->with('success', 'User Created Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);
        $user->delete();
        return redirect('/users');
    }
}
