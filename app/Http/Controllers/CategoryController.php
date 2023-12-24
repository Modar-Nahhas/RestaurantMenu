<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryRequest $request)
    {
        $data = $request->validated();
        $categories = Category::query()->applyAllFilters($data);
        return self::getJsonResponse('Success', $categories);
    }

    public function show(CategoryRequest $request, $id)
    {
        $data = $request->validated();
        $data['where_id'] = $id;
        $category = Category::query()->loadRelations($data)->filter($data)->firstOrfail();
        return self::getJsonResponse('Success', $category);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $newCategory = Category::query()->create($data);
        return self::getJsonResponse('Success', $newCategory);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        $category->update($data);
        return self::getJsonResponse('Success', $category);
    }

    public function getValidParentCategories()
    {
        $data['where_has_items'] = false;
        $data['list'] = true;
        $validParentCategories = Category::query()->filter($data)->getData($data);
        return self::getJsonResponse('Success', $validParentCategories);
    }

    public function getValidItemCategories()
    {
        $data['list'] = true;
        $validParentCategories = Category::query()
            ->whereDoesntHave('children')
            ->getData($data);
        return self::getJsonResponse('Success', $validParentCategories);
    }

}
