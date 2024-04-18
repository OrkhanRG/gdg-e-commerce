<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

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
