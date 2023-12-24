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

    public function show(DiscountRequest $request, $id)
    {
        $data = $request->validated();
        $data['where_id'] = $id;
        $discount = Discount::query()->loadRelations($data)->filter($data)->firstOrFail();
        return self::getJsonResponse('Success', $discount);
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

    public function update(DiscountRequest $request, Discount $discount)
    {
        $data = $request->validated();
        $discount->update($data);
        return self::getJsonResponse("Success", $discount);
    }

}
