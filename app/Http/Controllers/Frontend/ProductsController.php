<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{   
    public function index()
    {
    $products = Products::all();
    return view('frontend.products', compact('products'));
    }
    
     public function create()
    {
        return view('frontend.addproducts');
    }

    public function store(Request $request)
    {
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('productsimage'), $imageName);

        Products::create([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'image'       => $imageName,
        ]);

        return "Your product is added successfully!";
    }

}

