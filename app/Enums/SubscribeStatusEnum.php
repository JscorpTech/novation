<?php

namespace App\Enums;

enum SubscribeStatusEnum: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case EXPIRED = 'expired';
}
