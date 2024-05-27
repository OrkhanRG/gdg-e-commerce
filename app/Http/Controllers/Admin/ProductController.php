<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductType;
use App\Services\BrandService;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct(public CategoryService $categoryService, public BrandService $brandService)
    {
    }

    public function index()
    {
        dd('Product List Page');
//        return view('admin.product.index');
    }

    public function create()
    {
        $categories = $this->categoryService->getAllCategories();
        $brands = $this->brandService->getAllBrands();
        $types = ProductType::query()->get();
        return view('admin.product.create_edit', compact('types', 'brands', 'categories'));
    }

    public function store()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }

    public function checkSlug(Request $request)
    {
        $check = Product::query()->where('slug', Str::slug($request->slug))->first();

        return response()
            ->json()
            ->setData($check)
            ->setStatusCode(200)
            ->setCharset('utf-8')
            ->header('Content-Type', 'application/json')
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
}
