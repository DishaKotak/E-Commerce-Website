<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')
            ->with('success', 'Registration successfull. Please login.');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            Auth::login($user);

            $unixAfter24Hours = Carbon::now()
                ->addHours(24)
                ->timestamp;

            $disha = [
                'user_id' => $user->id,
                'expiry'  => $unixAfter24Hours
            ];

            Session::put('auth_session', $disha);

            app(\App\Http\Controllers\CartController::class)
                ->mergeSessionCart();

            return redirect('/');

        } else {

            return back()->with('error', 'Invalid credentials');
        }

    }

    public function logout()
    {
        Session::flush();

        return "Logout Successfully";
    }

    public function authorise(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);
    }

    public function dashboard()
    {
        return view('/dashboard');
    }
}
