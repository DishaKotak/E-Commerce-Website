<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function save(Request $request)
    {
    //      dd([
    //     'Request Data' => $request->all(),
    //     'Session Data' => session()->all(),
    // ]);
        session()->put('user', $request->username);
        return redirect()->back()->with('success', 'Session Saved');
    }

    public function update(Request $request)
    {
    //      dd([
    //     'Request Data' => $request->all(),
    //     'Session Data' => session()->all(),
    // ]);
        session()->put('user', $request->username);
        return redirect()->back()->with('success', 'Session Updated');
    }

    public function delete()
    {
    //      dd([
    //     'Request Data' => $request->all(),
    //     'Session Data' => session()->all(),
    // ]);
        session()->forget('user');
        return redirect()->back()->with('success', 'Session Deleted');
    }

    public function view()
    {
        $user = session()->get('user');
        if ($user) {
            return redirect()->back()->with('success', 'Session value: ' . $user);
        } else {
            return redirect()->back()->with('success', 'No session value found');
        }
    }
}
