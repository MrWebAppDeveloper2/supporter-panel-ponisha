<?php

namespace App\Repositories;

use App\Enums\Ticket\TicketStatus;
use App\Models\Ticket;
use App\Models\User;
use App\View\Components\InitialTicketMessage;
use Illuminate\Database\Eloquent\Collection;
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
        if(!$ticket = Ticket::create($data))
            return false;

        $chatData = [
            'name' => config('ticket.chat-name-prefix') . Str::words($ticket->title, 5),
            'meta' => Ticket::class . ",{$ticket->id}",
            'link' => config('ticket.chat-link-prefix') . $ticket->id,
        ];

        $chatRepository = app()->make(ChatRepository::class);

        if(!$chat = $chatRepository->create($chatData, [auth()->id()]))
            return false;

//        $initialMessageBody = app()->makeWith(InitialTicketMessage::class, ['ticket' => $ticket]);
        $initialMessageBody = new InitialTicketMessage($ticket);

        $messageData = [
            'body' => $initialMessageBody->render()->render(),
            'user_id' => $ticket->user_id
        ];

        $messageRepository = new MessageRepository($chat);

        if(!$messageRepository->create($messageData))
            return false;

        return $ticket;
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
