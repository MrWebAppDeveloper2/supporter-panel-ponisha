<?php

namespace App\Livewire\Messenger;

use App\Enums\Message\MessageStatus;
use App\Events\SeenMessage;
use App\Repositories\MessageRepository;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;

class History extends Component
{
    public \App\Models\Chat $chat;

    public Collection $messages;

    public bool $isContactOnline = false;

//    protected function getListeners()
//    {
//        return [
//            'NewMessageSentOnChat.' . $this->chat->id => 'pushMessage',
//            'echo-presence:' . $this->getChatSocketChannelName($this->chat) . ',MessageCreated' => 'pushMessage',
//            'echo-presence:' . $this->getChatSocketChannelName($this->chat) . ',SeenMessage' => 'contactSeenMyMessage',
//            'echo-presence:' . $this->getChatSocketChannelName($this->chat) . ',here' => 'checkContactOnline',
//            'echo-presence:' . $this->getChatSocketChannelName($this->chat) . ',joining' => 'contactWentOnline',
//            'echo-presence:' . $this->getChatSocketChannelName($this->chat) . ',leaving' => 'contactWentOffline',
//        ];
//    }

    #[On('notify-online-status')]
    public function changeOnlineStatus($chatId, $isOnline)
    {
        if($chatId == $this->chat->id)
            $this->isContactOnline = $isOnline;
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

    #[On('notify-contact-seen-message')]
    public function changeMessageStatus($chatId, $messageId)
    {
        if($this->chat->id == $chatId)
            $this->messages->where('id', $messageId)->first()->status = MessageStatus::SEEN->value;
    }

    #[On('i-seen-message')]
    public function iSeenMessage($messageId)
    {
        broadcast(new SeenMessage($messageId, $this->chat->id))->toOthers();
    }

    #[On('notify-new-message-sent')]
    #[On('notify-new-message')]
    public function pushSentMessage($chatId, $messageId)
    {
        if($this->chat->id == $chatId){
            $repository = app()->makeWith(MessageRepository::class, ['chat' => $this->chat]);

            $this->messages->push($repository->find($messageId));

            $this->dispatch('MessagesListUpdated');
        }
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
