<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use App\Models\User;

class AccountController extends Controller
{
    public function addresses()
    {
        $userId = session('auth_session')['user_id'];

        $addresses = Address::where('user_id', $userId)->get();

        return view('frontend.my-account.addresses', compact('addresses'));
    }

    public function storeAddress(Request $request)
    {
        $request->validate([
            'full_name'     => 'required',
            'phone'         => 'required',
            'email'         => 'required|email',
            'address_line1' => 'required',
            'state'         => 'required',
            'city'          => 'required',
            'postcode'      => 'required',
        ]);

        $userId = session('auth_session')['user_id'];

        Address::create([
            'user_id'       => $userId,
            'full_name'     => $request->full_name,
            'phone'         => $request->phone,
            'email'         => $request->email,
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'state'         => $request->state,
            'city'          => $request->city,
            'postcode'      => $request->postcode,
            'landmark'      => $request->landmark,
            'address_type'  => $request->address_type,
            'is_primary'    => $request->has('is_primary'),
        ]);

        return back()->with('success', 'Address Added Successfully');
    }

    public function setPrimary($id)
    {
        $userId = session('auth_session')['user_id'];

        Address::where('user_id', $userId)
            ->update(['is_primary' => 0]);

        Address::where('id', $id)
            ->where('user_id', $userId)
            ->update(['is_primary' => 1]);

        return back()->with('success', 'Primary address updated');
    }

    public function editAddress($id)
    {
        $userId = session('auth_session')['user_id'];

        $address = Address::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        return view('frontend.my-account.edit-address', compact('address'));
    }

    public function updateAddress(Request $request, $id)
    {
        $userId = session('auth_session')['user_id'];

        $address = Address::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        $address->update($request->all());

        return redirect()
            ->route('account.addresses')
            ->with('success', 'Address Updated Successfully');
    }

    public function deleteAddress($id)
    {
        $userId = session('auth_session')['user_id'];

        Address::where('id', $id)
            ->where('user_id', $userId)
            ->delete();

        return back()->with('success', 'Address Deleted Successfully');
    }

    public function profile()
    {
        $user = Auth::user();

        return view('frontend.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        if ($request->type == 'personal') {

            $request->validate([
                'first_name' => 'required',
                'last_name'  => 'required',
                'gender'     => 'required',
            ]);

            $user->update([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'gender'     => $request->gender,
            ]);

        } elseif ($request->type == 'account') {

            $request->validate([
                'mobile' => 'required|digits:10',
            ]);

            $user->update([
                'mobile' => '+91' . $request->mobile,
            ]);
        }

        return back()->with('success', 'Updated successfully');
    }
}
