<?php

namespace App\Livewire\Messenger;

use App\Models\Chat as ChatModel;
use App\Repositories\MessageRepository;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;

class History extends Component
{
    #[Reactive]
    public \App\Models\Chat $chat;

    public Collection $messages;

    protected function getListeners()
    {
        return [
            'NewMessageSent' => 'pushMessage',
            'echo-presence:' . $this->getChatSocketChannelName($this->chat) . ',MessageCreated' => 'pushMessage'
        ];
    }

    public function groupByMessages($messages)
    {
        return $messages->groupBy(function ($message) {
            return $message->created_at->format('Y-m-d H:i') . '_' . $message->user_id;
        });
    }

    public function pushMessage(array $data)
    {
        $repository = app()->makeWith(MessageRepository::class, ['chat' => $this->chat]);

        $this->messages->push($repository->find($data['id']));

        $this->dispatch('MessagesListUpdated');
    }

    public function mount()
    {

    }

    public function render()
    {
        $this->messages = $this->chat->messages()
            ->orderBy('created_at', 'asc')
            ->get();

        return view('livewire.pages.messenger.history')
            ->with('messages', $this->messages);
    }
}
