<?php

namespace App\Repositories;

use App\Models\Chat;

class ChatRepository
{
    public function create(array $data, array $user_ids):Chat|false
    {
        if(!$chat = Chat::create($data))
            return false;

        if(!$chat->members()->sync($user_ids))
            return false;

        return $chat;
    }
}
