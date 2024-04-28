<?php

namespace App\Livewire\Customer;

use App\Repositories\UserRepository;
use Livewire\Component;

class Index extends Component
{
    public function render(UserRepository $repository)
    {
        return view('livewire.pages.customer.index')
            ->with('customers', $repository->allCustomers());
    }
}
