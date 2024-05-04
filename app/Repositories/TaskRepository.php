<?php

namespace App\Repositories;

use App\Models\Task;
use App\Repositories\Chat\ChatRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

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

    public function create(array $data):Task|false
    {
        DB::beginTransaction();

        if(!$task = Task::create($data))
            return false;

        $chatRepository = app()->make(ChatRepository::class);

        if(!$chat = $chatRepository->createForTask($task))
            return false;

        DB::commit();

        return $task;
    }
}
