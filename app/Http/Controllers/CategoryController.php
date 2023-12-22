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

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $newCategory = Category::query()->create($data);
        return self::getJsonResponse('Success', $newCategory);
    }

    public function getValidParentCategories()
    {
        $data['where_has_items'] = false;
        $data['list'] = true;
        $validParentCategories = Category::query()->filter($data)->getData($data);
        return self::getJsonResponse('Success',$validParentCategories);
    }

}
