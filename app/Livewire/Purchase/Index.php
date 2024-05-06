<?php

namespace App\Livewire\Purchase;

use App\Repositories\PurchaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Index extends Component
{
    public Collection $purchases;

    public function mount(PurchaseRepository $repository)
    {
        $this->purchases = $repository->all();
    }

    public function render()
    {
        return view('livewire.pages.purchase.index')
            ->with('purchases', $this->purchases);
    }
}
