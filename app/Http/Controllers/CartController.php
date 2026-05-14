<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart($id)
    {
        $product = Products::findOrFail($id);

        if (Auth::check()) {

            $cart = Cart::where('user_id', Auth::id())
                ->where('product_id', $id)
                ->first();

            if ($cart) {
                $cart->increment('qty');
            } else {
                Cart::create([
                    'user_id'      => Auth::id(),
                    'product_id'   => $product->id,
                    'product_name' => $product->name,
                    'image'        => $product->image,
                    'qty'          => 1,
                    'price'        => $product->price,
                ]);
            }

            $count = Cart::where('user_id', Auth::id())->count();

        } else {

            $cart = session()->get('cart', []);

            if (isset($cart[$id])) {
                $cart[$id]['quantity']++;
            } else {
                $cart[$id] = [
                    'name'     => $product->name,
                    'price'    => $product->price,
                    'image'    => $product->image,
                    'quantity' => 1
                ];
            }

            session()->put('cart', $cart);
            $count = count($cart);
        }

        return response()->json([
            'success' => true,
            'count'   => $count
        ]);
    }

    public function cart()
    {
        $total = 0;

        if (Auth::check()) {

            $cart = Cart::where('user_id', Auth::id())->get();

            foreach ($cart as $item) {
                $total += $item->price * $item->qty;
            }

        } else {

            $cart = session()->get('cart', []);

            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }
        }

        return view('frontend.cart', compact('cart', 'total'));
    }

    public function remove($id)
    {
        if (Auth::check()) {

            Cart::where('user_id', Auth::id())
                ->where('product_id', $id)
                ->delete();

            $total = Cart::where('user_id', Auth::id())
                ->sum(DB::raw('price * qty'));

        } else {

            $cart = session()->get('cart', []);
            unset($cart[$id]);
            session()->put('cart', $cart);

            $total = 0;

            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }
        }

        return response()->json([
            'id'    => $id,
            'total' => (int) $total
        ]);
    }

    public function clear()
    {
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())->delete();
        } else {
            session()->forget('cart');
        }

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function increase($id)
    {
        if (Auth::check()) {

            Cart::where('user_id', Auth::id())
                ->where('product_id', $id)
                ->increment('qty');

            $cart = Cart::where('user_id', Auth::id())
                ->where('product_id', $id)
                ->first();

            $total = Cart::where('user_id', Auth::id())
                ->sum(DB::raw('price * qty'));

            return response()->json([
                'id'    => $id,
                'qty'   => $cart->qty,
                'total' => (int) $total
            ]);

        } else {

            $cart = session()->get('cart', []);
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);

            $total = 0;

            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            return response()->json([
                'id'    => $id,
                'qty'   => $cart[$id]['quantity'],
                'total' => $total
            ]);
        }
    }

    public function decrease($id)
    {
        if (Auth::check()) {

            $cart = Cart::where('user_id', Auth::id())
                ->where('product_id', $id)
                ->first();

            if ($cart && $cart->qty > 1) {
                $cart->decrement('qty');
            } else {
                Cart::where('user_id', Auth::id())
                    ->where('product_id', $id)
                    ->delete();
            }

            $cartItem = Cart::where('user_id', Auth::id())
                ->where('product_id', $id)
                ->first();

            $qty = $cartItem ? $cartItem->qty : 0;

            $total = Cart::where('user_id', Auth::id())
                ->sum(DB::raw('price * qty'));

            return response()->json([
                'id'    => $id,
                'qty'   => $qty,
                'total' => $total
            ]);

        } else {

            $cart = session()->get('cart', []);

            if ($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            } else {
                unset($cart[$id]);
            }

            session()->put('cart', $cart);

            $qty = isset($cart[$id]) ? $cart[$id]['quantity'] : 0;

            $total = 0;

            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            return response()->json([
                'id'    => $id,
                'qty'   => $qty,
                'total' => $total
            ]);
        }
    }

    public function mergeSessionCart()
    {
        if (Auth::check()) {

            $sessionCart = session()->get('cart', []);

            foreach ($sessionCart as $productId => $item) {

                $cart = Cart::where('user_id', Auth::id())
                    ->where('product_id', $productId)
                    ->first();

                if ($cart) {

                    $cart->qty += $item['quantity'];
                    $cart->save();

                } else {

                    Cart::create([
                        'user_id'      => Auth::id(),
                        'product_id'   => $productId,
                        'product_name' => $item['name'],
                        'image'        => $item['image'],
                        'qty'          => $item['quantity'],
                        'price'        => $item['price'],
                    ]);
                }
            }

            session()->forget('cart');
        }
    }
}
