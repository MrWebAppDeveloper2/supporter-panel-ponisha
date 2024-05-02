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
use Livewire\Attributes\Reactive;
use Livewire\Component;
use App\Models\Chat as ChatModel;

class Chat extends Component
{
    public ?ChatModel $chat;

    #[On('open-chat')]
    public function open(int $chatId)
    {
        $repository = app()->make(ChatRepository::class);

        $this->chat = $repository->find($chatId);
    }

    public function render()
    {
        return view('livewire.pages.messenger.chat');
    }
}
