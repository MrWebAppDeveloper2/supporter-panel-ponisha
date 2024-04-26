<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class RoleRepository
{
    public function all(array $columns = ['*']): Collection
    {
        return Role::all($columns);
    }

    public function paginate(int $perPage = 10)
    {
        return Role::paginate($perPage);
    }
}
