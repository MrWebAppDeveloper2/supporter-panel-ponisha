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

    public function create(array $data):User|false
    {
        return User::create($data);
    }

    public function delete(User $user):bool
    {
        return $user->delete();
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

    public function allOperators():Collection
    {
        return User::where('type', UserType::OPERATOR->value)
            ->get();
    }

    public function allAdmins():Collection
    {
        return User::where('type', UserType::ADMIN->value)
            ->get();
    }

    public function allCustomers():Collection
    {
        return User::where('type', UserType::CUSTOMER->value)
            ->get();
    }
}
