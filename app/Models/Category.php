<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mapi\Easyapi\Models\ApiModel;

class Category extends ApiModel
{
    public static int $maxCategoryLevel = 4;

    protected static function boot()
    {
        parent::boot();
        self::updated(function (Category $category) {
            $category->handleDiscountOnUpdate();
        });
    }

    protected $fillable = [
        'name',
        'parent_id',
        'has_items',
        'discount_id'
    ];

    public function discount(): BelongsTo
    {
        return $this->belongsTo(Discount::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public static function validCategoryForItems(int|string $categoryId): bool
    {
        return !Category::query()->where('parent_id', $categoryId)->exists();
    }

    private function handleDiscountOnUpdate(): void
    {
        if ($this->isDirty('discount_id') && isset($this->discount_id)) {
            $this->children()->whereNull('discount_id')->update([
                'discount_id' => $this->discount_id
            ]);
            $this->items()->whereNull('discount_id')->update([
                'discount_id' => $this->discount_id
            ]);
        }

    }
}
