<?php

namespace App\Livewire\Ticket;

use App\Models\Ticket;
use App\Repositories\TicketRepository;
use Livewire\Component;

class Index extends Component
{
    private TicketRepository $ticketRepository;

    public function __construct()
    {
        $this->ticketRepository = app()->make(TicketRepository::class);
    }

    public function delete(Ticket $ticket)
    {
        $this->authorize('delete', $ticket);

        $this->ticketRepository->delete($ticket);
    }

    public function mount()
    {
        $this->authorize('viewAny', Ticket::class);
    }

    public function render()
    {
        return view('livewire.pages.ticket.index')
            ->with('tickets', $this->ticketRepository->paginate());
    }
}
