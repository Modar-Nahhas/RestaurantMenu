<?php

namespace App\Models;

use App\Enums\DiscountTypeEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Mapi\Easyapi\Models\ApiModel;

class Item extends ApiModel
{

    protected static function boot()
    {
        parent::boot();
        self::creating(function (Item $item) {
            $item->validateCreation();
            $item->checkValidDiscount([
                DiscountTypeEnum::Item
            ]);
            $item->handleDiscount();
        });

        self::created(function (Item $item) {
            $item->category()->where('has_items', false)->update([
                'has_items' => true
            ]);
        });

        self::updating(function (Item $item) {
            if ($item->isDirty('discount_id')) {
                $item->checkValidDiscount([
                    DiscountTypeEnum::Category,
                    DiscountTypeEnum::Item,
                ]);
                $item->handleDiscount();
            }
        });
    }

    protected $casts = [
        'discount_id' => 'int',
        'category_id' => 'int',
        'price' => 'decimal:2'
    ];

    protected $fillable = [
        'name',
        'description',
        'price',
        'discount_id',
        'category_id'
    ];

    protected $appends = [
        'discount_value'
    ];

    public function price(): Attribute
    {
        return Attribute::make(
            get: fn($price) => $price - $this->discount_Value
        );
    }

    public function getDiscountValueAttribute(): float
    {
        $price = $this->getAttributes()['price'];
        $discountAmount = isset($this->discount_id) ? $this->discount->amount : 0;
        return $price * ($discountAmount / 100);
    }

    public function discount(): BelongsTo
    {
        return $this->belongsTo(Discount::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    private function checkValidDiscount(array $allowedTypes): void
    {
        if (isset($this->discount_id)) {
            $validDiscount = Discount::query()
                ->where('id', $this->discount_id)
                ->whereIn('type', $allowedTypes)
                ->exists();
            if (!$validDiscount) {
                throw new \Exception('Invalid discount for item');
            }
        }
    }

    private function validateCreation(): void
    {
        if (!Category::validCategoryForItems($this->category_id)) {
            throw new \Exception("Selected category can\'t be set to items");
        }
        if ($this->price < 0) {
            throw new \Exception('Price value should be a positive value');
        }
    }

    private function handleDiscount(): void
    {
        if (!isset($this->discount_id) && isset($this->category->discount_id)) {
            $this->discount_id = $this->category->discount_id;
        }
    }
}
