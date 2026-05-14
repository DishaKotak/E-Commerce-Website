<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function save(Request $request)
    {
        session()->put('user', $request->username);

        return redirect()
            ->back()
            ->with('success', 'Session Saved');
    }

    public function update(Request $request)
    {
        session()->put('user', $request->username);

        return redirect()
            ->back()
            ->with('success', 'Session Updated');
    }

    public function delete()
    {
        session()->forget('user');

        return redirect()
            ->back()
            ->with('success', 'Session Deleted');
    }

    public function view()
    {
        $user = session()->get('user');

        if ($user) {

            return redirect()
                ->back()
                ->with('success', 'Session value: ' . $user);

        } else {

            return redirect()
                ->back()
                ->with('success', 'No session value found');
        }
    }
}
