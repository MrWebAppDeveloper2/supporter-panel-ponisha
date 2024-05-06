<?php

namespace App\Livewire\Bug;

use App\Repositories\BugRepository;
use Livewire\Component;

class Index extends Component
{
    private BugRepository $bugRepository;

    public function __construct()
    {
        $this->bugRepository = app()->make(BugRepository::class);
    }

    public function render()
    {
        return view('livewire.pages.bug.index')
            ->with('bugs', $this->bugRepository->paginate());
    }
}
