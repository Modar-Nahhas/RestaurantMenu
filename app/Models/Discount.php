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

    protected $allowedFilters = [
        'type'
    ];
}
