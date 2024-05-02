<?php

namespace App\Repositories;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;

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
}
