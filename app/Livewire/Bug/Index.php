<?php

namespace App\Livewire\Bug;

use App\Models\Bug;
use App\Repositories\BugRepository;
use Livewire\Component;

class Index extends Component
{
    private BugRepository $bugRepository;

    public function delete(Bug $bug)
    {
        $this->authorize('delete', $bug);

        $this->bugRepository->delete($bug)?
            session()->now('alert-success', 'حذف شد !'):
            session()->now('alert-danger', 'وجود خطا در سرور !');
    }

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
