<?php

namespace App\Repositories;

use App\Models\Chat;
use App\Models\Message;
use App\Models\Ticket;
use App\Models\User;
use App\View\Components\InitialTicketMessage;

class MessageRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private Chat $chat
    )
    {}

    /**
     * @param array $data
     * @return Message|false
     */
    public function create(array $data):Message|false
    {
        return $this->chat->messages()->create($data);
    }

    public function createInitialTicketMessage(Ticket $ticket):Message|false
    {
        $initialMessageBody = app()->makeWith(InitialTicketMessage::class, ['ticket' => $ticket]);

        $messageData = [
            'body' => $initialMessageBody->render()->render(),
            'user_id' => $ticket->user_id
        ];

        return $this->create($messageData);
    }

    public function update(Message $message, array $data):bool
    {
        return $message->update($data);
    }

    public function find(int $id):Message|null
    {
        return Message::find($id);
    }
}
