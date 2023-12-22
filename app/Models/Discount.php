<?php

namespace App\Models;

use Mapi\Easyapi\Models\ApiModel;

class Discount extends ApiModel
{
    protected $fillable = [
        'name',
        'amount',
        'type'
    ];
}
