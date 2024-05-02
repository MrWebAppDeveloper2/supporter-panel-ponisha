<?php

namespace App\Livewire\Ticket;

use App\Enums\Ticket\TicketStatus;
use App\Enums\User\UserType;
use App\Models\Chat;
use App\Models\Ticket;
use App\Repositories\ChatRepository;
use App\Repositories\TicketRepository;
use Livewire\Attributes\Url;
use Livewire\Component;

class Index extends Component
{
    private TicketRepository $ticketRepository;

    #[Url]
    public string $status = '';

    public function __construct()
    {
        $this->ticketRepository = app()->make(TicketRepository::class);
    }

    public function openChat(Ticket $ticket)
    {
        $chat = Chat::where('meta', Ticket::class . ",$ticket->id")->first();

        if(!$chat and auth()->user() == UserType::CUSTOMER->value){
            $chatRepository = app()->make(ChatRepository::class);

            if($chat = $chatRepository->createForTicket($ticket))
                abort(500, 'Create chat failed !');
        }

        $this->redirect(route('chat', $chat));
    }

    public function delete(Ticket $ticket)
    {
        $this->authorize('delete', $ticket);

        $this->ticketRepository->delete($ticket);
    }

    public function closeTicket(Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $this->ticketRepository->update($ticket,
            [
                'status' => TicketStatus::CLOSED->value,
                'recipient_id' => null,
            ]) ?
            session()->now('alert-success', 'تیکت بسته شد !') :
            session()->now('alert-danger', 'وجود خطا در سرور !');
    }

    public function mount()
    {
        $this->authorize('viewAny', Ticket::class);
    }

    public function render()
    {
        if(auth()->user()->type == UserType::CUSTOMER->value)
            $tickets = $this->status == TicketStatus::CLOSED->value ?
                $this->ticketRepository->closedTickets() :
                $this->ticketRepository->notClosedTickets();
        else
            $tickets = $this->ticketRepository->getWithStatusScope($this->status);

        return view('livewire.pages.ticket.index')
            ->with('tickets', $tickets);
    }
}
