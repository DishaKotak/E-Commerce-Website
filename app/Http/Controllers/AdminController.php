<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;

class AdminController extends Controller
{
    public function showLogin()
    {
        return view('admin_login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (
            $user &&
            Hash::check($request->password, $user->password) &&
            $user->role === 'admin'
        ) {

            session([
                'admin_session' => [
                    'user_id' => $user->id,
                    'name'    => $user->name,
                    'role'    => $user->role
                ]
            ]);

            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Invalid admin credentials');
    }

    public function logout()
    {
        session()->forget('admin_session');

        return redirect('/admin-login');
    }

    public function orders()
    {
        $orders = Order::with(['user', 'items.product'])
            ->whereNull('deleted_at')
            ->whereHas('items')
            ->latest()
            ->get();

        return view('order', compact('orders'));
    }
}
