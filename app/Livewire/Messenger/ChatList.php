<?php

namespace App\Livewire\Messenger;

use App\Models\User;
use App\Repositories\ChatRepository;
use Illuminate\Database\Eloquent\Collection;
use function Laravel\Prompts\alert;
use App\Livewire\Messenger\Component;

class ChatList extends Component
{
    private ChatRepository $chatRepository;

    public Collection $chats;

    public string $search;

    public function updatedSearch()
    {
        $this->chats = \App\Models\Chat::where('name', 'LIKE', "%$this->search%")->get();
    }


    public function mount()
    {
        $this->chatRepository = app()->make(ChatRepository::class);

        $this->chats = $this->chatRepository->all();

        if(isset($this->chat))
            $this->loadMessages($this->chat);
    }

    public function render()
    {
        return view('livewire.pages.messenger.chat-list');
    }
}
