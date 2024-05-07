<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.category.create_edit', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only('name', 'short_description', 'description');

        $slug = Str::slug($request->slug);

        if (is_null($request->slug))
        {
            $slug = Str::slug(mb_substr($data['name'], 0, 70));
            $check = Category::query()->where('slug', $slug)->first();

            if ($check)
            {
                return redirect()->back()
                    ->withErrors(['slug' => 'Daxil etdiyiniz Slug boşdur və ya başqa bir kateqoriyada istifadə olunur!'])
                    ->withInput();
            }
        }

        $data['slug'] = $slug;
        $data['status'] = $request->has('status');

        if ($request->parent_id != -1)
        {
            $data['parent_id'] = $request->parent_id;
        }

        Category::create($data);

        alert()->success('Uğurlu!','Kateqoriya Yaradıldı!');
        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
