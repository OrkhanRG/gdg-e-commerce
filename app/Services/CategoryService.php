<?php

namespace App\Services;

use App\Models\Category;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\Throw_;

class CategoryService
{
    private array $prepareData = [];

    /**
     * @param Category $category
     */
    public function __construct(public Category $category)
    {
    }

    /**
     * @param Category $category
     * @return $this
     */
    public function setCategory(Category $category): self
    {
        $this->category = $category;
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
     * @return $this
     * @throws \Exception
     */
    public function prepareDataRequest(): self
    {
        $data = request()->only('name', 'short_description', 'description');

        $slug = $this->slugGenerate($data['name'], request()->slug);
        $data['slug'] = $slug;
        $data['status'] = request()->has('status');

        if (request()->parent_id != -1)
        {
            $data['parent_id'] = request()->parent_id;
        }

        $this->prepareData = $data;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getAllCategories():Collection
    {
        return $this->category::all();
    }

    /**
     * @param int $page
     * @param array $orderBy
     * @return LengthAwarePaginator
     */
    public function getAllCategoriesPaginate(int $page=10, array $orderBy=['id', 'DESC']): LengthAwarePaginator
    {
        return $this->category::orderBy($orderBy[0], $orderBy[1])->paginate($page);
    }

    /**
     * @param array|null $data
     * @return Category
     */
    public function create(array|null $data = null): Category
    {
        if (is_null($data))
        {
            $data = $this->prepareData;
        }

        return $this->category::create($data);
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

        return $this->category->update($data);
    }

    /**
     * @return bool
     */
    public function delete(): bool
    {
        return $this->category->delete();
    }

    /**
     * @param string $slug
     * @return Category|null
     */
    public function checkSlug(string $slug): Category|null
    {
        return $this->category::query()->where('slug', $slug)->first();
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

    /**
     * @param int $id
     * @return Category|null
     */
    public function getById(int $id): Category|null
    {
        return $this->category::query()->find($id);
    }


}
