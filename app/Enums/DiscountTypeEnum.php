<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum DiscountTypeEnum: string
{
    use EnumToArray;

    case AllMenu = 'all_menu';
    case Category = 'category';
    case Item = 'item';
}
