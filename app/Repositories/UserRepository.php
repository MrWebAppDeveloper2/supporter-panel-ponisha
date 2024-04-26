<?php

namespace App\Repositories;

use App\Enums\User\UserType;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    public function update(User $user, array $data):bool
    {
        return $user->update($data);
    }

    public function paginate(int $perPage = 20)
    {
        return User::paginate($perPage);
    }

    public function allExceptCustomers(): Collection
    {
        return User::where('type', '!=', UserType::CUSTOMER->value)
            ->get();
    }
}
