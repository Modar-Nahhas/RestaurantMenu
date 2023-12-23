<?php

namespace App\Models;

use Mapi\Easyapi\Models\ApiModel;

class Discount extends ApiModel
{

    protected $casts = [
        'amount' => 'decimal:2'
    ];
    protected $fillable = [
        'name',
        'amount',
        'type'
    ];

    protected $appends = [
        'formatted_type'
    ];

    protected $listColumnsToRetrieve = [
        'id', 'name'
    ];
    protected $allowedFilters = [
        'type'
    ];

    public function getFormattedTypeAttribute(): string
    {
        return ucfirst(str_replace('_', ' ', $this->type));
    }
}
