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

    public function create(array $data):Purchase|false
    {
        return Purchase::create($data);
    }

    public function delete(Purchase $purchase):bool
    {
        return $purchase->delete();
    }
}
