<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ItemRequest $request)
    {
        $data = $request->validated();
        $discounts = Item::query()->applyAllFilters($data);
        return self::getJsonResponse('Success', $discounts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        $data = $request->validated();
        $newDiscount = Item::query()->create();
        return self::getJsonResponse('Success', $newDiscount);
    }
}
