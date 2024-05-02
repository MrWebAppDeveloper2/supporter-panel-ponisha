<?php

namespace App\Livewire\Messanger;

use App\Models\Scopes\ChatUserScope;
use App\Repositories\ChatRepository;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Livewire\Component;

class Chat extends Component
{
    public $chats;

    public function mount(ChatRepository $chatRepository)
    {
        $this->chats = $chatRepository->all();
    }

    public function render()
    {
        return view('livewire.pages.messanger.chat');
    }
}
