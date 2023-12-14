<?php

namespace App\Enums;

enum PaymentType: int
{
    case Cash = 0;
    case Card   = 1;
    case P2P   = 2;
    case Money_Order  = 3;
    case Check     = 4;
}
