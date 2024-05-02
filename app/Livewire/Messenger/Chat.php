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

    public Collection $messages;

    public $chats;

    public function getGroupByMessages()
    {
        return $this->messages->groupBy(function ($message) {
            return $message->created_at->format('Y-m-d H:i') . '_' . $message->user_id;
        });
    }

    #[On('NewMessageSent')]
    public function pushMessage(int $id)
    {
        $repository = app()->makeWith(MessageRepository::class, ['chat' => $this->chat]);

        $this->messages->push($repository->find($id));
    }

    public function open(ChatModel $chat)
    {
        $this->chat = $chat;

        $this->loadMessages($chat);
    }

    public function loadMessages(ChatModel $chat)
    {
        $this->messages = $chat->messages()
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function mount(ChatRepository $chatRepository)
    {
        $this->chats = $chatRepository->all();

        if(isset($this->chat))
            $this->loadMessages($this->chat);

    }

    public function render()
    {
        return view('livewire.pages.messenger.chat');
    }
}
