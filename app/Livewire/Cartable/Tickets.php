<?php

namespace App\Livewire\Cartable;

use App\Models\Ticket;
use App\Repositories\TicketRepository;
use Livewire\Component;

class Tickets extends Component
{
    public $tickets;

    public function getListeners()
    {
        $listeners = [];

        foreach (auth()->user()->workgroups as $workgroup)
            $listeners["echo-private:workgroup.{$workgroup->id},NewTicket"] = 'newTicket';

        return $listeners;
    }

    public function newTicket($event)
    {
        $ticket = $event['ticket'];

        if($ticket = Ticket::find($ticket['id'])){
            $this->tickets->push($ticket);

            $this->tickets = $this->tickets->sortByDesc('created_at');
        }
    }

    /**
     * Accept ticket for handling and chat with ticket owner
     *
     * @param Ticket $ticket
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function accept(Ticket $ticket)
    {
        $repository = new TicketRepository();

        if($repository->accept($ticket))
            $this->redirect(route('chat', $repository->findRelevantChat($ticket)));
    }

    public function mount(TicketRepository $ticketRepository)
    {
        $this->tickets =
            $ticketRepository->notClosedTickets(false)
                ->sortByDesc('created_at');
    }

    public function render()
    {
        return view('livewire.pages.cartable.tickets')
            ->with('tickets', $this->tickets);
    }
}
