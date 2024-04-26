<?php

namespace App\Enums\User;

enum UserType: string
{
    case ADMIN = 'admin';

    case CUSTOMER = 'customer';
}
