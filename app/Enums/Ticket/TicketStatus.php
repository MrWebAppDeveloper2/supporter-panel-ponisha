<?php

namespace App\Enums\Ticket;

enum TicketStatus: string
{
    case PENDING = 'pending';

    case CLOSED = 'closed';

    case WAITING = 'waiting'; // Waiting for receive with one of users
}
