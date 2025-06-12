<?php

namespace App\Enums;

enum SubscribePaymentStatusEnum: string
{
    case PENDING = 'pending';
    case PAID = 'paid';
}
