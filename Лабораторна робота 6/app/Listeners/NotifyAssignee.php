<?php

namespace App\Listeners;

use App\Events\TaskCreated;
use Illuminate\Support\Facades\Log;

class NotifyAssignee
{
    public function handle(TaskCreated $event)
    {
        Log::info('New task created for user: ' . $event->task->assignee_id);
    }
}
