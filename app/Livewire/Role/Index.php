<?php

namespace App\Livewire\Role;

use App\Models\Role;
use App\Repositories\RoleRepository;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[Layout('layouts.app')]
    public function render(RoleRepository $repository)
    {
        return view('livewire.role.index', [
            'roles' => Role::paginate()
        ]);
    }
}
