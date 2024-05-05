<?php

namespace App\Livewire\Task;

use App\Enums\Task\TaskType;
use App\Enums\User\UserType;
use App\Models\Chat;
use App\Models\Task;
use App\Repositories\Chat\ChatRepository;
use App\Repositories\TaskRepository;
use Livewire\Attributes\Url;
use Livewire\Component;

class Index extends Component
{
    #[Url]
    public string $type;

    private TaskRepository $taskRepository;

    public function openChat(Task $task)
    {
        $chat = $this->taskRepository->findRelevantChat($task);

        $this->redirect(route('chat', $chat));
    }

    public function __construct()
    {
        $this->taskRepository = app()->make(TaskRepository::class);
    }

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
