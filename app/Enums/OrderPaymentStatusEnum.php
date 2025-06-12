<?php

namespace App\Enums;

enum OrderPaymentStatusEnum: string
{
    case PENDING = 'pending';
    case PAID = 'paid';
}
