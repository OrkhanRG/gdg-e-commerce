<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function myOrders()
    {
        return view('front.my-orders');
    }

    public function myOrderDetail()
    {
        return view('front.my-order-detail');
    }
}
