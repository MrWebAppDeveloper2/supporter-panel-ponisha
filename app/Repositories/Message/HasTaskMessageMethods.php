<?php

namespace App\Repositories\Message;

use App\Models\Message;
use App\Models\Task;
use App\View\Components\ConfirmCloseTaskMessage;
use App\View\Components\InitialTaskMessage;
use App\View\Components\TaskClosedMessage;

trait HasTaskMessageMethods
{
    public function createInitialTaskMessage(Task $task):Message|false
    {
        $initialMessageBody = app()->makeWith(InitialTaskMessage::class, ['task' => $task]);

        $messageData = [
            'body' => $initialMessageBody->render()->render(),
            'user_id' => $task->creator_id
        ];

        return $this->create($messageData);
    }

    public function createConfirmCloseTaskMessage(Task $task):Message|false
    {
        $confirmCloseTask = app()->makeWith(ConfirmCloseTaskMessage::class, ['task' => $task]);

        $messageData = [
            'body' => $confirmCloseTask->render()->render(),
            'user_id' => $task->recipient_id
        ];

        return $this->create($messageData);
    }

    public function createTaskClosedMessage(Task $task):Message|false
    {
        $taskClosedMessage = app()->makeWith(TaskClosedMessage::class, ['task' => $task]);

        $messageData = [
            'body' => $taskClosedMessage->render()->render(),
            'user_id' => $task->creator_id
        ];

        return $this->create($messageData);
    }
}
