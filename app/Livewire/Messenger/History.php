<?php

namespace App\Livewire\Messenger;

use App\Models\Chat as ChatModel;
use App\Repositories\MessageRepository;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;

class History extends Component
{
    public \App\Models\Chat $chat;

    public Collection $messages;

    protected function getListeners()
    {
        return [
            'NewMessageSent' => 'pushMessage',
            'echo-presence:' . $this->getChatSocketChannelName($this->chat) . ',MessageCreated' => 'pushMessage'
        ];
    }

    public function getGroupByMessages()
    {
        return $this->messages->groupBy(function ($message) {
            return $message->created_at->format('Y-m-d H:i') . '_' . $message->user_id;
        });
    }

    public function pushMessage(array $data)
    {
        $repository = app()->makeWith(MessageRepository::class, ['chat' => $this->chat]);

        $this->messages->push($repository->find($data['id']));

        $this->dispatch('MessagesListUpdated');
    }

    public function loadMessages(ChatModel $chat)
    {
        $this->messages = $chat->messages()
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function mount()
    {
        $this->loadMessages($this->chat);
    }

    public function render()
    {
        return view('livewire.pages.messenger.history');
    }
}
