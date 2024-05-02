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

    public bool $isContactOnline = false;

    protected function getListeners()
    {
        return [
            'NewMessageSentOnChat.' . $this->chat->id => 'pushMessage',
            'echo-presence:' . $this->getChatSocketChannelName($this->chat) . ',MessageCreated' => 'pushMessage',
            'echo-presence:' . $this->getChatSocketChannelName($this->chat) . ',here' => 'checkContactOnline',
            'echo-presence:' . $this->getChatSocketChannelName($this->chat) . ',joining' => 'contactWentOnline',
            'echo-presence:' . $this->getChatSocketChannelName($this->chat) . ',leaving' => 'contactWentOffline',
        ];
    }

    public function checkContactOnline($event)
    {
        $this->isContactOnline = count($event) > 1;
    }

    public function contactWentOnline($event)
    {
        $this->isContactOnline = true;
    }

    public function contactWentOffline($event)
    {
        $this->isContactOnline = false;
    }

    public function groupByMessages($messages)
    {
        return $messages->groupBy(function ($message) use ($messages) {
            $changeUserAt = $messages
                ->where('id', '>' , $message->id)
                ->where('user_id', '!=' , $message->user_id)
                ->first();

            return $message->created_at->format('Y-m-d H:i') . '_' . $message->user_id . ($changeUserAt ? '_before_message_' . $changeUserAt->id : '');
        });
    }

    public function pushMessage(array $data)
    {
        $repository = app()->makeWith(MessageRepository::class, ['chat' => $this->chat]);

        $this->messages->push($repository->find($data['id']));

        $this->dispatch('MessagesListUpdated');
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
