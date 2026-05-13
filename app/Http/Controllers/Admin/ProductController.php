<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;

class ProductController extends Controller
{
    public function index()
    {
       $products = Products::all();

       return view('admin.product', compact('products'));
    }

    public function addproduct()
    {
       return view('admin.addproduct');
    }

    public function destroy($id)
    {
        $product = Products::find($id);

        if($product)
            {
                $product->delete();
            }

            return redirect()->back()->with('success', 'Product Deleted Successfully');
    }

}
