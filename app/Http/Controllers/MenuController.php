<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequest;
use App\Models\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MenuRequest $request)
    {
        $data = $request->validated();
        $discounts = Menu::query()->applyAllFilters($data);
        return self::getJsonResponse('Success', $discounts);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $newMenu = Menu::query()->create($data);
        return self::getJsonResponse('Success', $newMenu);
    }

}
