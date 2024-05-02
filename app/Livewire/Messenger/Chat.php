<?php

namespace App\Livewire\Messenger;

use App\Models\Message;
use App\Models\Scopes\ChatUserScope;
use App\Repositories\ChatRepository;
use App\Repositories\MessageRepository;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Chat as ChatModel;

class Chat extends Component
{
    public ?ChatModel $chat;

    public function open(ChatModel $chat)
    {
        $this->chat = $chat;

        $this->loadMessages($chat);
    }

    public function render()
    {
        return view('livewire.pages.messenger.chat');
    }
}
