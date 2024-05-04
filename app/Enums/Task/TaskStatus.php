<?php

namespace App\Enums\Task;

enum TaskStatus: string
{
    case SENT = 'ارسال شده';

    case PENDING = 'در حال رسیدگی';

    case CLOSED = 'بسته شده';
}
