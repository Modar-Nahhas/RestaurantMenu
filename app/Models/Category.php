<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mapi\Easyapi\Models\ApiModel;

class Category extends ApiModel
{
    protected $fillable = [
        'name',
        'parent_id',
        'level',
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

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);

    }
}
