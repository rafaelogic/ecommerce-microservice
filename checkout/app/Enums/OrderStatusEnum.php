<?php

namespace App\Enums;

enum OrderStatusEnum:string
{
    case CANCELLED = 'cancelled';
    case FULFILLED = 'fulfilled';
    case OPEN = 'open';
}