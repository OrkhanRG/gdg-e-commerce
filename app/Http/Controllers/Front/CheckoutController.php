<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    public function checkout()
    {
        return view('front.checkout');
    }
}
