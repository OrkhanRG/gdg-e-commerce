<?php

namespace App\Services;

use App\Models\Brand;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class BrandService
{
    private array $prepareData = [];

    public function __construct(public Brand $brand, public ImageService $imageService)
    {
    }

    /**
     * @param Brand $category
     * @return $this
     */
    public function setCategory(Brand $brand): self
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setPrepareData(array $data): self
    {
        $this->prepareData = $data;
        return $this;
    }

    /**
     * @param int $id
     * @return Brand|null
     */
    public function getById(int $id): Brand|null
    {
        return $this->brand::query()->find($id);
    }

/*    public function getAllBrands(): Collection
    {
        return $this->brand::all();
    }*/

    public function getAllBrandsPaginate(int $page=10, array $orderBy=['id', 'DESC']): LengthAwarePaginator
    {
        return $this->brand::query()->orderBy($orderBy[0], $orderBy[1])->paginate($page);
    }

    /**
     * @throws Exception
     */
    public function prepareDataRequest(): self
    {
        $data = request()->only('name', 'order');

        $logoPath = $this->uploadLogo($data['name']);

        if (!is_null($logoPath) || (is_null($logoPath) && is_null($this->brand->logo) ))
        {
            $data['logo'] = $logoPath;
        }

        if (!is_null($logoPath) && !is_null($this->brand->logo))
        {
            $this->deleteLogo();
        }

        $slug = $this->slugGenerate($data['name'], request()->slug);
        $data['slug'] = $slug;
        $data['status'] = request()->has('status');
        $data['is_featured'] = request()->has('is_featured');



        $this->prepareData = $data;

        return $this;
    }

    /**
     * @param array|null $data
     * @return Brand
     */
    public function create(array|null $data=null): Brand
    {
        if (is_null($data))
        {
            $data = $this->prepareData;
        }

        return  $this->brand::create($data);
    }

    /**
     * @param array|null $data
     * @return bool
     */
    public function update(array|null $data = null):bool
    {
        if (is_null($data))
        {
            $data = $this->prepareData;
        }

        /*if (request()->hasFile('logo'))
        {
            $this->deleteLogo();
        }*/


        return $this->brand->update($data);
    }

    /**
     * @return bool
     */
    public function delete(): bool
    {
        $this->deleteLogo();
        return $this->brand->delete();
    }

    /**
     * @param string $slug
     * @return Brand|null
     */
    public function checkSlug(string $slug): Brand|null
    {
        return $this->brand::query()->where('slug', $slug)->first();
    }

    /**
     * @param string $name
     * @param string|null $slug
     * @return string
     * @throws Exception
     */
    public function slugGenerate(string $name, string|null $slug): string
    {
        if (is_null($slug))
        {
            $slug = Str::slug(mb_substr($name, 0, 70));
            $check = $this->checkSlug($slug);

            if ($check)
            {
                Throw new \Exception('Daxil etdiyiniz Slug boşdur və ya başqa bir kateqoriyada istifadə olunur!', 400);
            }
        }
        else
        {
            $slug = Str::slug(mb_substr($slug, 0, 70));
        }

        return $slug;
    }

    public function uploadLogo(string $fileName): string|null
    {
        if (request()->hasFile('logo'))
        {
            $logo = request()->file('logo');
            $path = 'uploads/brands/original';
            $fileName = str_replace("storage", "", $fileName);

            return $this->imageService->singleUpload($logo, $fileName, $path);
        }

        return null;
    }

    public function deleteLogo():void
    {
        $logo = $this->brand->logo;
        $path = is_null($logo) ? '' : $this->pathEditor($logo);

        if (file_exists(storage_path('app/' . $path)))
        {
            $this->imageService->deleteImage($path);
        }
    }

    public function pathEditor(string $path): string
    {
        $path = str_replace('storage', '', $path);

        return 'public' . $path;
    }

}
