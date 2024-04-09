<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
