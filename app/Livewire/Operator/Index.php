<?php

namespace App\Livewire\Operator;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Index extends Component
{
    public Collection $users;

    public function mount(UserRepository $repository)
    {
        $this->authorize('viewAny', User::class);

        $this->users = $repository->allOperators();
    }

    public function render()
    {
        return view('livewire.operator.index');
    }
}
