<?php

namespace App\Repositories;

use App\Models\Chat;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ChatRepository
{
    public function all(array $columns = ['*']):Collection
    {
        return Chat::all($columns);
    }

    public function create(array $data, array $user_ids):Chat|false
    {
        if(!$chat = Chat::create($data))
            return false;

        if(!$chat->members()->sync($user_ids))
            return false;

        return $chat;
    }

    public function createForTicket(Ticket $ticket):Chat|false
    {
        DB::beginTransaction();

        $chatData = [
            'name' => config('ticket.chat-name-prefix') . Str::words($ticket->title, 5),
            'meta' => Ticket::class . ",{$ticket->id}",
            'link' => config('ticket.chat-link-prefix') . $ticket->id,
        ];

        if(!$chat = $this->create($chatData, [auth()->id()]))
            return false;

        $messageRepository = app()->makeWith(MessageRepository::class, ['chat' => $chat]);

        if(!$messageRepository->createInitialTicketMessage($ticket))
            return false;

        DB::commit();

        return $chat;
    }
}
