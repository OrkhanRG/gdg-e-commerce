<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductType;
use App\Services\BrandService;
use App\Services\CategoryService;
use Illuminate\Http\Request;

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
}
