<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;

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
        try {
            DB::beginTransaction();
            /** @var Menu $newMenu */
            $newMenu = Menu::query()->create($data);
            if (isset($data['items'])) {
                $newMenu->items()->sync($data['items']);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        return self::getJsonResponse('Success', $newMenu);
    }

    public function update(MenuRequest $request, Menu $menu)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();
            $menu->update($data);
            if (isset($data['items'])) {
                $menu->items()->sync($data['items']);
            }
            $menu->load('items');
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        return self::getJsonResponse('Success', $menu);
    }

}
