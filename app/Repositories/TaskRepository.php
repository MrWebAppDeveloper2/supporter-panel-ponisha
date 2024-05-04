<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository
{
    public function all(array $columns = ['*']):Collection
    {
        return Task::all();
    }

    public function paginate(int $perPage = 20)
    {
        return Task::paginate($perPage);
    }

    public function allSubmits(bool $pagination = true, int $perPage = 20)
    {
        return Task::where('creator_id', auth()->id())->paginate($perPage);
    }

    public function allReceives(bool $pagination = true, int $perPage = 20)
    {
        return Task::where('recipient_id', auth()->id())->paginate($perPage);
    }
}
