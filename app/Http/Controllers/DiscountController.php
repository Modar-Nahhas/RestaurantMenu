<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscountRequest;
use App\Models\Discount;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DiscountRequest $request)
    {
        $data = $request->validated();
        $discounts = Discount::query()->applyAllFilters($data);
        return self::getJsonResponse('Success', $discounts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DiscountRequest $request)
    {
        $data = $request->validated();
        $newDiscount = Discount::query()->create($data);
        return self::getJsonResponse('Success', $newDiscount);
    }

}
