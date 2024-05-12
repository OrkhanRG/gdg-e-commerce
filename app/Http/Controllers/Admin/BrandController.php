<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandStoreRequest;
use App\Http\Requests\BrandUpdateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Brand;
use App\Services\BrandService;
use App\Traits\myException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class BrandController extends Controller
{
    use myException;
    public function __construct(public  BrandService $brandService)
    {
    }

    public function index()
    {
        $brands = $this->brandService->getAllBrandsPaginate(orderBy: ['order', 'desc']);
        return view('admin.brand.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brand.create_edit');
    }

    public function store(BrandStoreRequest $request)
    {
        try
        {
            $this->brandService->prepareDataRequest()->create();

            alert()->success('Uğurlu!', 'Brend Yaradıldı!');
            return redirect()->route('admin.brand.index');

        }
        catch (Throwable $exception)
        {
            return $this->exception($exception,'Brend yaradılmadı!');
        }
    }

    public function edit(Brand $brand)
    {
        return view('admin.brand.create_edit', compact('brand'));
    }

    public function update(BrandUpdateRequest $request, Brand $brand)
    {
        try
        {
            $this->brandService->setCategory($brand)->prepareDataRequest()->update();

            alert()->success('Uğurlu!', 'Brend Güncəlləndi!');
            return redirect()->route('admin.brand.index');

        }
        catch (Throwable $exception)
        {
            return $this->exception($exception, 'Brend Güncəllənmədi!');
        }
    }

    public function delete(Brand $brand)
    {
        try
        {
            $delete = $this->brandService->setCategory($brand)->delete();

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
            return $this->exception($exception, 'Kateqoriya Silinmədi!');
        }
    }

    public function changeStatus(Request $request)
    {
        $brandID = $request->id;

        $brand = $this->brandService->getById($brandID);

        if (is_null($brand)) {
            return response()
                ->json()
                ->setData(['message' => 'Brend Tapılmadı'])
                ->setStatusCode(404)
                ->setCharset('utf-8')
                ->header('Content-Type', 'application/json')
                ->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }

        $data = ['status' => !$brand->status];
        $this->brandService->setCategory($brand)->setPrepareData($data)->update();

        return response()
            ->json()
            ->setData($brand)
            ->setStatusCode(200)
            ->setCharset('utf-8')
            ->header('Content-Type', 'application/json')
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function changeIsFeatured(Request $request)
    {
        $brandID = $request->id;

        $brand = $this->brandService->getById($brandID);

        if (is_null($brand)) {
            return response()
                ->json()
                ->setData(['message' => 'Kateqoriya Tapılmadı'])
                ->setStatusCode(404)
                ->setCharset('utf-8')
                ->header('Content-Type', 'application/json')
                ->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }

        $data = ['is_featured' => !$brand->is_featured];
        $this->brandService->setCategory($brand)->setPrepareData($data)->update();

        return response()
            ->json()
            ->setData($brand)
            ->setStatusCode(200)
            ->setCharset('utf-8')
            ->header('Content-Type', 'application/json')
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
}
