<?php

namespace App\Enums;

enum DealerType: int
{
    case Standard  = 0;
    case Premimum  = 1;
    case Exclusive = 2;
    case Silver    = 3;
    case Sponsor   = 4;
    case Blocked   = 5;
}
