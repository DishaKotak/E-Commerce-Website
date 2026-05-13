<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->query('query');

        $products = Products::where('name', 'LIKE', "%$query%")
                            ->orwhere('description', 'LIKE', "%$query%")
                            ->get();
                            
        return view('frontend.search', compact('products', 'query'));
    }
}
