<?php

namespace App\Repositories;

use App\Models\Purchase;
use Illuminate\Database\Eloquent\Collection;

class PurchaseRepository
{
    public function all(array $columns = ['*']):Collection
    {
        return Purchase::all($columns);
    }
}
