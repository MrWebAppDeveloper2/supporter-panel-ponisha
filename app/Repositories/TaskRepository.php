<?php

namespace App\Repositories;

use App\Enums\Task\TaskStatus;
use App\Models\Chat;
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
        return $pagination ?
            Task::where('recipient_id', auth()->id())->paginate($perPage):
            Task::where('recipient_id', auth()->id())->get();
    }

    public function allNotClosedTasks(bool $pagination = true, int $perPage = 20)
    {
        return $pagination ?
            Task::where('status', '!=', TaskStatus::CLOSED->value)->paginate($perPage):
            Task::where('status', '!=', TaskStatus::CLOSED->value)->get();
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

    public function findRelevantChat(Task $task):Chat|null
    {
        return Chat::withoutGlobalScopes()->where('meta', Task::class . ",$task->id")->first();
    }
}
