<?php

namespace App\Livewire\Meeting;

use App\Repositories\MeetingRepository;
use Livewire\Component;

class Index extends Component
{
    private MeetingRepository $repository;

    public function __construct()
    {
        $this->repository = app()->make(MeetingRepository::class);
    }

    public function mount()
    {
    }

    public function render()
    {
        return view('livewire.pages.meeting.index')
            ->with('meetings', $this->repository->all());
    }
}
