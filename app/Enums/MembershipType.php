<?php

namespace App\Enums;

enum MembershipType: int
{
    case Standard = 0; //common
    case Copper   = 1; //dealer 
    case Silver   = 2; //dealer
    case Gold     = 3; //dealer
    case Platinum = 4; //dealer

    case Premium  = 5; //seller
    case Exclusive= 6; //seller

    case Blocked  = 7;// ccommon 
}