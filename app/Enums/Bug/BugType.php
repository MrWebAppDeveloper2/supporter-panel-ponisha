<?php

namespace App\Enums\Bug;

enum BugType: string
{
    case PENDING = 'pending';

    case FIXED = 'fixed';
}
