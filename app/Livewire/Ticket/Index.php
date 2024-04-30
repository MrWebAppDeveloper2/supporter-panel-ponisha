<?php

namespace App\Livewire\Ticket;

use App\Repositories\TicketRepository;
use Livewire\Component;

class Index extends Component
{
    public function render(TicketRepository $ticketRepository)
    {
        return view('livewire.pages.ticket.index')
            ->with('tickets', $ticketRepository->paginate());
    }
}
