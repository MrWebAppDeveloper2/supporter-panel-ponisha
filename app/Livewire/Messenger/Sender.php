<?php

namespace App\Livewire\Messenger;

use App\Repositories\MessageRepository;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Sender extends Component
{
    private MessageRepository $repository;

    public \App\Models\Chat $chat;

    #[Validate(['required', 'string'])]
    public string $body;

    public function send()
    {
        $this->validate();

        $repository = app()->makeWith(MessageRepository::class, ['chat' => $this->chat]);

        $message = $repository->create([
            'body' => $this->body,
            'user_id' => auth()->id()
        ]);

        if($message){
            $this->reset('body');

            $this->dispatch('NewMessageSent', data: ['id' => $message->id]);
        } else
            session()->now('toast-danger', 'مشکلی پیش آمده است !');
    }

    public function mount()
    {
        $this->repository = app()->makeWith(MessageRepository::class, ['chat' => $this->chat]);
    }

    public function render()
    {
        return view('livewire.pages.messenger.sender');
    }
}
