<?php

namespace App\Repositories;

use App\Models\Chat;
use Illuminate\Database\Eloquent\Collection;

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
}
