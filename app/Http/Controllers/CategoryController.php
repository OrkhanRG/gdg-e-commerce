<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class CategoryController extends Controller
{
    public function __construct(public CategoryService $categoryService)
    {
    }


    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function index()
    {
        $categories = $this->categoryService->getAllCategoriesPaginate();
        return view('admin.category.index', compact('categories'));
    }


    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function create()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('admin.category.create_edit', compact('categories'));
    }


    /**
     * @param CategoryStoreRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryStoreRequest $request)
    {
        try
        {
            $this->categoryService->prepareDataRequest()->create();

            alert()->success('Uğurlu!', 'Kateqoriya Yaradıldı!');
            return redirect()->route('admin.category.index');

        }
        catch (Throwable $exception)
        {
           return $this->exceptionCategory($exception, 'Kateqoriya yaradılmadı!');
        }
    }


    /**
     * @param Category $category
     * @return void
     */
    public function show(Category $category)
    {
        //
    }


    /**
     * @param Category $category
     * @return Application|Factory|View|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function edit(Category $category)
    {
        $categories = $this->categoryService->getAllCategories();
        return view('admin.category.create_edit', compact('category', 'categories'));
    }


    /**
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        try
        {
            $this->categoryService->setCategory($category)->prepareDataRequest()->update();

            alert()->success('Uğurlu!', 'Kateqoriya Güncəlləndi!');
            return redirect()->route('admin.category.index');

        }
        catch (Throwable $exception)
        {
            return $this->exceptionCategory($exception, 'Kateqoriya Güncəllənmədi!');
        }
    }


    /**
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category)
    {
        try
        {
            $delete = $this->categoryService->setCategory($category)->delete12();

            if (!$delete)
            {
                alert()->warning('Diqqət!', 'Kateqoriya Silinmədi!');
                return redirect()->back();
            }

            alert()->success('Uğurlu!', 'Kateqoriya Silindi!');
            return redirect()->back();
        }
        catch (Throwable $exception)
        {
           return $this->exceptionCategory($exception, 'Kateqoriya Silinmədi!');
        }


    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function changeStatus(Request $request)
    {
        $categoryID = $request->id;

        $category = $this->categoryService->getById($categoryID);

        if (is_null($category)) {
            return response()
                ->json()
                ->setData(['message' => 'Kateqoriya Tapılmadı'])
                ->setStatusCode(404)
                ->setCharset('utf-8')
                ->header('Content-Type', 'application/json')
                ->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }

        $data = ['status' => !$category->status];
        $this->categoryService->setCategory($category)->setPrepareData($data)->update();

        return response()
            ->json()
            ->setData($category)
            ->setStatusCode(200)
            ->setCharset('utf-8')
            ->header('Content-Type', 'application/json')
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param $exception
     * @param $errorDescription
     * @return RedirectResponse
     */
    public function exceptionCategory($exception, $errorDescription = 'Xəta yarandı!')
    {
        alert()->error('Xəta!', $errorDescription);

        if ($exception->getCode() == 400)
        {
            return redirect()
                ->back()
                ->withErrors(['slug' => $exception->getMessage()])
                ->withInput();
        }

        Log::error($exception->getMessage(), [$exception->getTraceAsString()]);
        return redirect()->back();
    }
}
