<?php

namespace App\Livewire\Messenger;

class Component extends \Livewire\Component
{
    public function getChatSocketChannelName(\App\Models\Chat $chat):string
    {
        return config('chat.channel-prefix') . $chat->id;
    }
}
