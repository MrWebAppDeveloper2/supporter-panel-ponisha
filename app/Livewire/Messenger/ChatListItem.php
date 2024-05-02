<?php

namespace App\Livewire\Messenger;

use App\Models\Chat as ChatModel;
use App\Repositories\ChatRepository;
use App\Repositories\MessageRepository;

class ChatListItem extends Component
{
    public bool $isOnline = false;

    public ChatModel $chat;

    public string $lastMessage;

    public int $newMessagesCount = 0;

    private MessageRepository $messageRepository;

    protected function getListeners()
    {
        return [
            'echo-presence:' . $this->getChatSocketChannelName($this->chat) . ',here' => 'checkContactOnline',
            'echo-presence:' . $this->getChatSocketChannelName($this->chat) . ',joining' => 'contactWentOnline',
            'echo-presence:' . $this->getChatSocketChannelName($this->chat) . ',leaving' => 'contactWentOffline',
            'echo-presence:' . $this->getChatSocketChannelName($this->chat) . ',MessageCreated' => 'newMessageReceived',
            'NewMessageSentOnChat.' . $this->chat->id => 'newMessageSent',
        ];
    }

    public function checkContactOnline($event)
    {
        $this->isOnline = count($event) > 1;
    }

    public function contactWentOnline($event)
    {
        $this->isOnline = true;
    }

    public function contactWentOffline($event)
    {
        $this->isOnline = false;
    }

    public function newMessageSent($data)
    {
        $this->lastMessage = $data['body'];
//        $repository = app()->makeWith(MessageRepository::class, ['chat', $this->chat]);
//
//        $this->lastMessage = $repository->find($event['id'])->body;
//
//        $this->newMessagesCount++;
    }

    public function newMessageReceived($event)
    {
        $repository = app()->makeWith(MessageRepository::class, ['chat', $this->chat]);

        $this->lastMessage = $repository->find($event['id'])->body;

        $this->newMessagesCount++;
    }

    public function open(ChatModel $chat)
    {
        $this->dispatch('open-chat', $chat->id);
    }

    public function mount()
    {
        $this->lastMessage = $this->chat->messages()->latest()->first()?->body;
    }

    public function render()
    {
        return view('livewire.pages.messenger.chat-list-item');
    }
}
