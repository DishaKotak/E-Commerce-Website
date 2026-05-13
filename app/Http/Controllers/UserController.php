<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('userdetail', compact('user'));
    }

    public function edit($id)
    {
    $user = User::findOrFail($id);
    return view('useredit', compact('user'));
    }

    public function update(Request $request, $id)
    {
    $user = User::findOrFail($id);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->status = $request->status;

    $user->save();

    return redirect('/users')->with('success', 'User updated successfully!');
    }

    public function destroy($id)
    {
    $user = User::findOrFail($id); 
    $user->delete();               

    return redirect('/users')->with('success', 'User deleted successfully!');
    }

    public function adduser()
    {
    return view('adduser'); 
    }

    public function store(Request $request)
    {
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed|min:6',
        'status' => 'required|in:0,1', 
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'status' => $request->status,
    ]);

    return redirect('/users')->with('success', 'User added successfully');
    }

}
