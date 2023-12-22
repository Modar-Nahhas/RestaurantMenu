<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Mapi\Easyapi\Models\ApiModel;

class Menu extends ApiModel
{
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

    public function getTotalValueAttribute(): int
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
}
