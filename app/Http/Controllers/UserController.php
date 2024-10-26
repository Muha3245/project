<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=User::get();
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=User::findorFail($id);
        $roles=Role::get();
        $hasRoles=$user->roles->pluck('id');
        return view('users.edit',compact('user','roles','hasRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user=User::findorFail($id);

        $validator=Validator::make($request->all(),[
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,'.$id.',id'
        ]);
        if($validator->fails()){
            return redirect()->route('user.edit')->withInput()->withErrors($validator);
        }

        $user->name=$request->name;
        $user->email=$request->email;
        $user->save();

        $user->syncRoles($request->role);
        return redirect()->route('user.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=User::findorFail($id);
        $user->delete();
        return redirect()->route('user.index');
    }
}
