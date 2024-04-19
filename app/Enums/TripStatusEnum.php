<?php

namespace App\Enums;

enum TripStatusEnum:string {
    case ASSIGNED = 'ASSIGNED';
    case AT_VENDOR = 'AT_VENDOR';
    case PICKED = 'PICKED';
    case DELIVERED = 'DELIVERED';
}
