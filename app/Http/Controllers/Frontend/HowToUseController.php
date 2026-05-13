<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HowToUseController extends Controller
{
    public function index()
    {
        return view('frontend.how-to-use');
    }
}
