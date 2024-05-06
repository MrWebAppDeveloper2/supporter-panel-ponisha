<?php

namespace App\Livewire\Bug;

use App\Models\Bug;
use Livewire\Component;

class Show extends Component
{
    public Bug $bug;

    public function mount()
    {
        $this->authorize('view', $this->bug);
    }

    public function render()
    {
        return view('livewire.pages.bug.show');
    }
}
