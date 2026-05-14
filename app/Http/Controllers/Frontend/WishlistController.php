<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return view('frontend.wishlist', compact('wishlist'));
    }

    public function toggle($id)
    {
        $wishlist = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->first();

        if ($wishlist) {

            $wishlist->delete();

            return back()->with([
                'message' => 'Item removed from Wishlist',
                'type'    => 'danger'
            ]);

        } else {

            Wishlist::create([
                'user_id'   => Auth::id(),
                'product_id'=> $id
            ]);
        }

        return back()->with([
            'message' => 'Added to your Wishlist',
            'type'    => 'success'
        ]);
    }

    public function destroy($id)
    {
        $wishlist = Wishlist::where('user_id', Auth::id())
            ->where('id', $id)
            ->first();

        if (!$wishlist) {
            return redirect()
                ->back()
                ->with('message', 'Wishlist item not found');
        }

        $wishlist->delete();

        return redirect()->back()->with([
            'message' => 'Item removed from Wishlist',
            'type'    => 'danger'
        ]);
    }
}
