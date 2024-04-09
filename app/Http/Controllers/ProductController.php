<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function prodcuts()
    {
        return view('front.products');
    }

    public function prodcutDetail()
    {
        return view('front.product-detail');
    }
}
