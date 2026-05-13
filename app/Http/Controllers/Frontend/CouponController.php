<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function apply(Request $request)
    {
        $userId = session('auth_session.user_id');
        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if (!$coupon) {
            return response()->json(['status' => 'error', 'msg' => 'Invalid Coupon']);
        }

        // user already use check
        $alreadyUsed = DB::table('coupon_usages')
            ->where('user_id', Auth::id())
            ->where('coupon_id', $coupon->id)
            ->exists();

        if ($alreadyUsed) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Coupon already used'
            ]);
        }

        // cart total
        $total = Auth::check()
        ? Cart::where('user_id', Auth::id())->sum(DB::raw('price * qty'))
        : collect(session()->get('cart', []))->sum(fn($i)=> $i['price'] * $i['quantity']);

        // discount logic
        if ($coupon->type == 'fixed') {
            $discount = $coupon->discount_amount;
        } elseif ($coupon->type == 'percent') {
            $discount = ($total * $coupon->discount_amount) / 100;
        } else {
            $discount = 0;
        }

        // session store
        session()->put('coupon', [
            'id' => $coupon->id,
            'discount' => $discount
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Coupon Applied Successfully',
            'discount' => $discount,
            'total' => $total - $discount
        ]);
    }

    public function remove()
    {
        session()->forget('coupon');

        $total = Auth::check()
        ? Cart::where('user_id', Auth::id())->sum(DB::raw('price * qty'))
        : collect(session()->get('cart', []))->sum(fn($i)=> $i['price'] * $i['quantity']);

        return response()->json([
            'total' => $total
        ]);
    }
}
