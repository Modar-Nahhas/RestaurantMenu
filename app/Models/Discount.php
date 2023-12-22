<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mapi\Easyapi\Models\ApiModel;

class Discount extends ApiModel
{
    protected $fillable = [
        'name',
        'amount',
        'type'
    ];
}
