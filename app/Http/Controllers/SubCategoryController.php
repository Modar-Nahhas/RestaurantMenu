<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubCategoryRequest;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubCategoryRequest $request)
    {
        $data = $request->validated();
        $subCategories = SubCategory::query()->applyAllFilters($data);
        return self::getJsonResponse('Success', $subCategories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubCategoryRequest $request)
    {
        $data = $request->validated();
        $newSubCategory = SubCategory::query()->create($data);
        return self::getJsonResponse('Success', $newSubCategory);
    }
}
