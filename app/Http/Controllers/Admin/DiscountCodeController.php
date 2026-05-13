<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class DiscountCodeController extends Controller
{
        public function index()
        {
            $coupons = Coupon::all();
            return view('admin.coupon.list', compact('coupons'));
        }

        public function create()
        {
            return view('admin.coupon.create');
        }

        public function store(Request $request)
        {
            $request->validate([
                'code'=>'required',
                'discount_amount'=>'required'
            ]);

            if($request->start_at && $request->start_at < now())
                {
                    return back()->with('error', 'Start date must be future');
                }

            if($request->expire_at && $request->expire_at < $request->start_at)
                {
                    return back()->with('error', 'Expire date must be greater than start date');
                }

            Coupon::create($request->all());

            return redirect('admin/coupons')->with('success', 'Coupon Added');
        }

        public function edit($id)
        {
            $coupon = Coupon::find($id);

                if(!$coupon) {
                    return back()->with('error', 'Record not found');
                }

                return view('admin.coupon.edit', compact('coupon'));
        }

        public function update(Request $request, $id)
        {
            $coupon = Coupon::find($id);

            if(!$coupon)
                {
                    return back()->with('error', 'Record not found');
                }

                $request->validate ([
                    'code' => 'required',
                    'discount_amount' => 'required'
                ]);

                if($request->expire_at && $request->expire_at < $request->start_at){
                return back()->with('error','Expire date must be greater');
                }

                $coupon->update($request->all());

                return redirect('admin/coupons')->with('success','Updated successfully');
        }

        public function destroy($id)
        {
            $coupon = Coupon::find($id);

            if(!$coupon){
                return back()->with('error','Record not found');
            }

            $coupon->delete();

            return back()->with('success','Deleted successfully');
        }
}


