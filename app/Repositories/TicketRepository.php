<?php

namespace App\Repositories;

use App\Enums\Ticket\TicketStatus;
use App\Models\Chat;
use App\Models\Ticket;
use App\Models\User;
use App\View\Components\InitialTicketMessage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TicketRepository
{
    /**
     * Returns waiting status tickets
     *
     * @param bool $pagination
     * @param int|null $perpage
     * @return Collection
     */
    public function waitingTickets(bool $pagination = true, ?int $perpage = 10):mixed
    {
        $query = Ticket::where('status', TicketStatus::WAITING->value);

        return $pagination ?
            $query->paginate($perpage) :
            $query->get();
    }

    /**
     * Returns pending status tickets
     *
     * @param bool $pagination
     * @param int|null $perpage
     * @return Collection
     */
    public function pendingTickets(bool $pagination = true, ?int $perpage = 10):mixed
    {
        $query = Ticket::where('status', TicketStatus::PENDING->value);

        return $pagination ?
            $query->paginate($perpage) :
            $query->get();
    }

    /**
     * Returns closed status tickets
     *
     * @param bool $pagination
     * @param int|null $perpage
     * @return Collection
     */
    public function closedTickets(bool $pagination = true, ?int $perpage = 10):mixed
    {
        $query = Ticket::where('status', TicketStatus::CLOSED->value);

        return $pagination ?
            $query->paginate($perpage) :
            $query->get();
    }

    /**
     * Returns tickets where their status are not equivalent to closed
     *
     * @param bool $pagination
     * @param int|null $perpage
     * @return Collection
     */
    public function notClosedTickets(bool $pagination = true, ?int $perpage = 10):mixed
    {
        $query = Ticket::where('status', '!=', TicketStatus::CLOSED->value);

        return $pagination ?
            $query->paginate($perpage) :
            $query->get();
    }

    public function getWithStatusScope(string $status, bool $pagination = true, ?int $perpage = 10):mixed
    {
        $query = Ticket::where('status', $status);

        return $pagination ?
            $query->paginate($perpage) :
            $query->get();
    }

    /**
     * Create new ticket with relevant chat and its initial message
     *
     * @param array $data
     * @return Ticket|false
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function create(array $data):Ticket|false
    {
        DB::beginTransaction();

        if(!$ticket = Ticket::create($data))
            return false;

        $chatRepository = app()->make(ChatRepository::class);

        if(!$chat = $chatRepository->createForTicket($ticket))
            return false;

        DB::commit();

        return $ticket;
    }

    /**
     * Accept ticket for handling and answer to customer often it does with operator
     *
     * @param Ticket $ticket
     * @param User|null $acceptable the user/operator who accept ticket, current user id will set if it is null
     * @return bool
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function accept(Ticket $ticket, ?User $acceptable = null):bool
    {
        DB::beginTransaction();

        if(!$this->update($ticket,
            [
                'status' => TicketStatus::PENDING->value,
                'recipient_id' => $acceptable ?? auth()->id()
            ]
        ))
            return false;

        if(!$chat = $this->findRelevantChat($ticket))
            return false;

        $chatRepository = app()->make(ChatRepository::class);

        $chatRepository->joinMember($chat, $acceptable ?? auth()->user());

        DB::commit();

        return true;
    }

    public function findRelevantChat(Ticket $ticket):Chat|null
    {
        return Chat::where('meta', Ticket::class . ",$ticket->id")->first();
    }

    public function update(Ticket $ticket, array $data):bool
    {
        return $ticket->update($data);
    }

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
