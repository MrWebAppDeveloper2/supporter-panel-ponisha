<?php

namespace App\Livewire\Workgroup;

use App\Models\User;
use App\Models\Workgroup;
use Livewire\Component;

class Users extends Component
{
    public Workgroup $workgroup;

    public function detachUser(User $user)
    {
        $this->authorize('update', $this->workgroup);

        $this->workgroup->users()->detach($user)?
            session()->now('alert-success', 'کاربر از این گروه کاری حذف شد !'):
            session()->now('alert-danger', 'وجود خطا در سرور !');
    }

    public function mount()
    {
        $this->authorize('view', $this->workgroup);
    }

    public function render()
    {
        return view('livewire.workgroup.users')
            ->with('users', $this->workgroup->users);
    }
}
