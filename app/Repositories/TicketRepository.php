<?php

namespace App\Repositories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Collection;

class TicketRepository
{
    public function delete(Ticket $ticket):bool
    {
        return (bool)$ticket->delete();
    }

    public function paginate(int $perPage = 20)
    {
        return Ticket::paginate($perPage);
    }

    public function all(array $columns = ['*']):Collection
    {
        return Ticket::all($columns);
    }
}
