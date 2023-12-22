<?php

namespace App\Models;

use App\Enums\DiscountTypeEnum;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mapi\Easyapi\Models\ApiModel;

class Category extends ApiModel
{
    public static int $maxCategoryLevel = 4;

    protected static function boot()
    {
        parent::boot();
        self::creating(function (Category $category) {
            $category->checkValidDiscount();
        });

        self::updating(function (Category $category) {
            $category->handleDiscountOnUpdate();
        });
    }

    protected $casts = [
        'level' => 'int',
        'parent_id' => 'int',
        'has_items' => 'bool',
        'discount_id' => 'int'
    ];

    protected $fillable = [
        'name',
        'parent_id',
        'has_items',
        'discount_id'
    ];

    protected $listColumnsToRetrieve = [
        'id', 'name'
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

    protected function checkValidDiscount(): void
    {
        if (isset($this->discount_id)) {
            $validDiscount = Discount::query()
                ->where('id', $this->discount_id)
                ->where('type', DiscountTypeEnum::Category)
                ->exists();
            if (!$validDiscount) {
                throw new \Exception('Invalid discount for category');
            }
        }
    }

    private function handleDiscountOnUpdate(): void
    {
        if ($this->isDirty('discount_id') && isset($this->discount_id)) {
            $this->checkValidDiscount();
            $this->children()->whereNull('discount_id')->update([
                'discount_id' => $this->discount_id
            ]);
            $this->items()->whereNull('discount_id')->update([
                'discount_id' => $this->discount_id
            ]);
        }

    }
}
