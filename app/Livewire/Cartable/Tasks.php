<?php

namespace App\Livewire\Cartable;

use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Tasks extends Component
{
    public Collection $tasks;

    public function open(Task $task)
    {
        $repository = app()->make(TaskRepository::class);

        $this->redirect(route('chat', $repository->findRelevantChat($task)));
    }

    public function mount(TaskRepository $taskRepository)
    {
        $this->authorize('viewAny', Task::class);

        $this->tasks = $taskRepository->allNotClosedTasks(false)
            ->sortByDesc('created_at');
    }

    public function render()
    {
        return view('livewire.pages.cartable.tasks')
            ->with('tasks', $this->tasks);
    }
}
