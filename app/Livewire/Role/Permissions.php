<?php

namespace App\Livewire\Role;

use App\Models\Role;
use Livewire\Component;

class Permissions extends Component
{
    public Role $role;

    public function render()
    {
        return view('livewire.role.permissions');
    }
}
