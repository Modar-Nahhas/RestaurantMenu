<?php

namespace App\Models;

use App\Models\Scopes\SubCategoryScope;

class SubCategory extends Category
{
    protected $table = 'categories';

    protected static function boot()
    {
        parent::boot();
        self::addGlobalScope(SubCategoryScope::class);

        static::creating(function (SubCategory $subCategory) {
            $subCategory->load('parent');
            $subCategory->level = $subCategory->parent->level++;
            $subCategory->validateCreation();
            $subCategory->handleDiscountOnCreation();
        });
    }

    private function validateCreation(): void
    {
        if (!isset($this->parent_id)) {
            throw new \Exception('Sub-categories should have a parent');
        } else {
            $parent = $this->parent;
            if ($parent->has_items) {
                throw new \Exception('This parent can\'t have a category child');
            }
            if ($parent->level >= Category::$maxCategoryLevel) {
                throw new \Exception('Can\'t create a category of this level');
            }
        }
    }

    private function handleDiscountOnCreation(): void
    {
        if (!isset($this->discount_id) && isset($this->parent->discount_id)) {
            $this->discount_id = $this->parent->discount_id;
        } else {
            $this->checkValidDiscount();
        }
    }


}
