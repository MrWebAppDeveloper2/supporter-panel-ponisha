<?php

namespace App\Livewire\Task;

use App\Enums\Task\TaskType;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Livewire\Attributes\Url;
use Livewire\Component;

class Index extends Component
{
    #[Url]
    public string $type;

    private TaskRepository $taskRepository;

    public function mount()
    {
        $this->authorize('viewAny', Task::class);

        $this->taskRepository = app()->make(TaskRepository::class);
    }

    public function render()
    {
        return view('livewire.pages.task.index')
            ->with(
                'tasks',
                    isset($this->type) && $this->type == TaskType::SUBMIT->name ?
                    $this->taskRepository->allSubmits() :
                    $this->taskRepository->allReceives()
            );
    }
}
