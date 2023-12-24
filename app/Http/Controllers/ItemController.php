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

    public function show(ItemRequest $request, $id)
    {
        $data = $request->validated();
        $data['where_id'] = $id;
        $discount = Item::query()->loadRelations($data)->filter($data)->firstOrFail();
        return self::getJsonResponse('Success', $discount);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        $data = $request->validated();
        $newDiscount = Item::query()->create($data);
        return self::getJsonResponse('Success', $newDiscount);
    }

    public function update(ItemRequest $request, Item $item)
    {
        $data = $request->validated();
        $item->update($data);
        return self::getJsonResponse('Success', $item);
    }
}
