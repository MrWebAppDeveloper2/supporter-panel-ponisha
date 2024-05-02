<?php

namespace App\Livewire\Messenger;

use App\Models\Scopes\ChatUserScope;
use App\Repositories\ChatRepository;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Chat as ChatModel;

class Chat extends Component
{
    public ?ChatModel $chat;

    public $messages;

    public $chats;

    public function getGroupByMessages()
    {
        return $this->messages->groupBy(function ($message) {
            return $message->created_at->format('Y-m-d H:i') . '_' . $message->user_id;
        });
    }

    public function mount(ChatRepository $chatRepository)
    {
        $this->chats = $chatRepository->all();

        if(isset($this->chat))
            $this->messages = $this->chat->messages()
                ->orderBy('created_at', 'asc')
                ->get();
    }

    public function render()
    {
        return view('livewire.pages.messanger.chat');
    }
}
