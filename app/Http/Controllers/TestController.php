<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function getMessage()
    {
    return response()->json([
        'message' => 'Hello Disha 👋 Laravel se message aaya!'
    ]);
    }
}
