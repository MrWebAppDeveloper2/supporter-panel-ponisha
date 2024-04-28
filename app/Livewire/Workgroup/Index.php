<?php

namespace App\Livewire\Workgroup;

use App\Models\Workgroup;
use App\Repositories\WorkgroupRepository;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public function mount()
    {
        $this->authorize('viewAny', Workgroup::class);
    }

    public function render(WorkgroupRepository $repository)
    {
        return view('livewire.workgroup.index')
            ->with('workgroups', $repository->paginate());
    }
}
