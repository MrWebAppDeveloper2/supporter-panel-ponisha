<?php

namespace App\Livewire\Messenger;

class Component extends \Livewire\Component
{
    public function getChatSocketChannelName(\App\Models\Chat $chat):string
    {
        return config('chat.channel-prefix') . $chat->id;
    }

    public function notifyOnlineStatus(int $chatId, bool $online)
    {
        $this->dispatch('notify-online-status', chatId: $chatId, isOnline: $online);
    }

    public function notifyNewMessage(int $chatId, int $messageId)
    {
        $this->dispatch('notify-new-message', chatId: $chatId, messageId: $messageId);
    }

    public function notifyContactSeenMessage(int $chatId, int $messageId)
    {
        $this->dispatch('notify-contact-seen-message', chatId: $chatId, messageId: $messageId);
    }

    public function notifyNewMessageSent(int $chatId, int $messageId, string $body)
    {
        $this->dispatch('notify-new-message-sent', chatId: $chatId, messageId: $messageId, body: $body);
    }
}
