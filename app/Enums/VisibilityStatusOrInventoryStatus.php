<?php

namespace App\Enums;

enum VisibilityStatusOrInventoryStatus: int
{
    case Inactive = 0;
    case Active   = 1;
    case Expired  = 2;
    case Archived = 3;
    case Invalid  = 4;
    case Blocked  = 5;
}
