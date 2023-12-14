<?php

namespace App\Enums;

enum PaymentStatus: int
{
    case Free = 0;
    case Paid   = 1;
    case Expired   = 2;
    case Declined   = 3;
    case Rejected     = 4;
}
