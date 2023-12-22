<?php

namespace App\Models;

use App\Enums\DiscountTypeEnum;
use App\Models\Scopes\MenuScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Mapi\Easyapi\Models\ApiModel;

class Menu extends ApiModel
{
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new MenuScope());

        static::creating(function (Menu $menu) {
            $menu->checkValidDiscount();
        });

        static::updating(function (Menu $menu) {
            if ($menu->isDirty('discount_id')) {
                $menu->checkValidDiscount();
            }
        });
    }

    protected $casts = [
        'amount' => 'decimal:2'
    ];

    protected $fillable = [
        'name',
        'discount_id',
        'user_id'
    ];

    protected $with = [
        'items'
    ];

    protected $appends = [
        'totalValue'
    ];

    public function getTotalValueAttribute(): float
    {
        $discountAmount = isset($this->discount_id) ? $this->discount->amount : 0;
        $totalValue = $this->items->sum('price');
        return $totalValue - ($totalValue * ($discountAmount / 100));
    }

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class);
    }

    public function discount(): BelongsTo
    {
        return $this->belongsTo(Discount::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function checkValidDiscount(): void
    {
        if (isset($this->discount_id)) {
            $validDiscount = Discount::query()
                ->where('id', $this->discount_id)
                ->where('type', DiscountTypeEnum::AllMenu)
                ->exists();
            if (!$validDiscount) {
                throw new \Exception('Invalid discount for menu');
            }
        }

    }
}
