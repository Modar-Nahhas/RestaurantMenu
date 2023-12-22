<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Mapi\Easyapi\Models\ApiModel;

class Item extends ApiModel
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'discount_id',
        'category_id'
    ];

    public function discount(): BelongsTo
    {
        return $this->belongsTo(Discount::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
