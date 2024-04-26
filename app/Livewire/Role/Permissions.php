<?php

namespace App\Livewire\Role;

use App\Models\Permission;
use App\Models\Role;
use App\Repositories\PermissionRepository;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Permissions extends Component
{
    public Role $role;

    public $permissions;

    #[Validate([
        'checkedPermissions' => 'required',
        'checkedPermissions.*' => [
            'exists:' . Permission::class . ',id'
        ],
    ])]
    public array $checkedPermissions;

    /**
     * @return void
     */
    public function save():void
    {
        $this->validate();

        $this->role->permissions()->sync($this->checkedPermissions);

        $this->role->save();

        session()->now('alert-success', 'ذخیره شد !');
    }

    public function mount(PermissionRepository $repository)
    {
        $this->checkedPermissions = $this->role->permissions->pluck('id')->toArray();

        $this->permissions = $repository->all();
    }

    public function render()
    {
        return view('livewire.role.permissions');
    }
}
