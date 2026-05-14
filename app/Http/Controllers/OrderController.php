<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function checkout()
    {
        $userId = session('auth_session.user_id');

        if (Auth::check()) {

            $cart = \App\Models\Cart::where('user_id', $userId)->get();
            $addresses = Address::where('user_id', $userId)->get();

        } else {

            $cart = session()->get('cart');
        }

        if (!$cart || count($cart) == 0) {
            return redirect()
                ->route('cart.view')
                ->with('error', 'Cart is empty');
        }

        return view('frontend.checkout', compact('cart', 'addresses'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'phone_no'             => 'required',
            'shipping_address_id'  => 'required|exists:addresses,id',
            'billing_address_id'   => 'required|exists:addresses,id',
        ]);

        $userId = session('auth_session.user_id');

        // ───── Cart fetch ─────
        if (Auth::check()) {

            $cartItems = \App\Models\Cart::where('user_id', $userId)->get();

            $cart = [];

            foreach ($cartItems as $item) {
                $cart[$item->product_id] = [
                    'quantity' => $item->qty,
                    'price'    => $item->price
                ];
            }

        } else {

            $cart = session()->get('cart', []);
        }

        // ───── Total ─────
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // ───── Coupon ─────
        $discount = 0;
        $couponData = null;

        if (session()->has('coupon')) {

            $couponData = session('coupon');

            $alreadyUsed = DB::table('coupon_usages')
                ->where('user_id', $userId)
                ->where('coupon_id', $couponData['id'])
                ->exists();

            if ($alreadyUsed) {
                session()->forget('coupon');
                return back()->with('error', 'Coupon already used');
            }

            $discount = $couponData['discount'];
        }

        $finalTotal = $total - $discount;

        // ───── Order create ─────
        $order = Order::create([
            'order_date'          => Carbon::now(),
            'user_id'             => $userId,
            'total_amount'        => $total,
            'discount'            => $discount,
            'final_amount'        => $finalTotal,
            'shipping_address'    => 'N/A',
            'billing_address'     => 'N/A',
            'shipping_address_id' => $request->shipping_address_id,
            'billing_address_id'  => $request->billing_address_id,
            'phone_no'            => $request->phone_no,
            'status'              => 'pending',
            'tracking_id'         => 'ORD' . strtoupper(uniqid())
        ]);

        // ───── Order items ─────
        foreach ($cart as $product_id => $item) {

            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $product_id,
                'qty'        => $item['quantity'],
                'price'      => $item['price'],
                'total'      => $item['price'] * $item['quantity']
            ]);
        }

        // ───── Clear cart ─────
        if (Auth::check()) {
            \App\Models\Cart::where('user_id', $userId)->delete();
        } else {
            session()->forget('cart');
        }

        // ───── Coupon usage save ─────
        if ($couponData) {

            DB::table('coupon_usages')->insert([
                'user_id'    => $userId,
                'coupon_id'  => $couponData['id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Coupon::where('id', $couponData['id'])
                ->increment('used_count');

            session()->forget('coupon');
        }

        return "Order placed successfully!";
    }

    public function myOrders()
    {
        $userId = session('auth_session.user_id');

        $orders = Order::with('items.product')
            ->where('user_id', $userId)
            ->where('total_amount', '>', 0)
            ->latest()
            ->get();

        return view('frontend.my-orders', compact('orders'));
    }

    public function orderDetails(int $id)
    {
        $order = Order::with(['shippingAddress', 'billingAddress'])
            ->findOrFail($id);

        $addresses = Address::where('user_id', $order->user_id)->get();

        return view('orderdetails', compact('order', 'addresses'));
    }

    public function trackForm()
    {
        return view('frontend.track-order');
    }

    public function trackOrder(Request $request)
    {
        $request->validate([
            'tracking_id' => 'required'
        ]);

        $order = Order::where('tracking_id', $request->tracking_id)->first();

        if (!$order) {
            return back()->with('error', 'Invalid Tracking ID');
        }

        return view('frontend.track-result', compact('order'));
    }

    public function updateStatus(Request $request, int $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'status' => 'required'
        ]);

        $order->status = $request->status;
        $order->save();

        return "Order status updated";
    }

    public function updateAddress(Request $request, int $id)
    {
        $order = Order::findOrFail($id);

        if ($request->shipping_address_id) {
            $order->shipping_address_id = $request->shipping_address_id;
            $order->billing_address_id = null;
        }

        if ($request->billing_address_id) {
            $order->billing_address_id = $request->billing_address_id;
            $order->shipping_address_id = null;
        }

        $order->save();

        return back()->with('success', 'Address Updated Successfully');
    }

    public function increaseQty($id)
    {
        $item = OrderItem::findOrFail($id);

        $item->qty += 1;
        $item->total = $item->qty * $item->price;
        $item->save();

        $this->updateOrderTotal($item->order_id);

        return back();
    }

    public function decreaseQty(int $id)
    {
        $item = OrderItem::findOrFail($id);

        if ($item->qty > 1) {

            $item->qty -= 1;
            $item->total = $item->qty * $item->price;
            $item->save();

            $this->updateOrderTotal($item->order_id);

            return back();
        }
    }

    public function deleteItem(int $id)
    {
        $item = OrderItem::findOrFail($id);
        $order = Order::findOrFail($item->order_id);

        $item->delete();

        $this->updateOrderTotal($order->id);

        if ($order->items()->count() == 0) {
            $order->delete();
        }

        return back();
    }

    private function updateOrderTotal(int $orderId)
    {
        $order = Order::findOrFail($orderId);

        $total = OrderItem::where('order_id', $orderId)->sum('total');

        $order->total_amount = $total;
        $order->save();
    }

    public function show(int $id)
    {
        $order = DB::table('order')
            ->leftJoin('addresses', 'order.shipping_address_id', '=', 'addresses.id')
            ->select([
                'order.*',
                'addresses.full_name',
                'addresses.address_line1 as user_address',
                'addresses.phone as phone'
            ])
            ->where('order.id', $id)
            ->first();

        $items = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('order_items.order_id', $id)
            ->select([
                'order_items.*',
                'products.name as product_name',
            ])
            ->get();

        return view('frontend.order-detailsuser', compact('order', 'items'));
    }

    public function downloadInvoice(int $id)
    {
        $order = Order::with(['items.product', 'address'])
            ->findOrFail($id);

        $pdf = Pdf::loadView('frontend.invoice', compact('order'));

        return $pdf->download('invoice_' . $order->id . '.pdf');
    }
}
