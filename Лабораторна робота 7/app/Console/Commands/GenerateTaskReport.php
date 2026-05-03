<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;

class GenerateTaskReport extends Command
{
    protected $signature = 'tasks:report {--project_id=}';

    protected $description = 'Generate tasks report';

    public function handle()
    {
        $projectId = $this->option('project_id');

        $query = Task::query();

        if ($projectId) {
            $query->where('project_id', $projectId);
        }

        $tasks = $query->get();

        if ($tasks->isEmpty()) {
            $this->warn('Задач не знайдено');
            return;
        }

        $this->info('Список задач');

        $this->table(
            ['ID', 'Назва', 'Статус', 'Дедлайн'],
            $tasks->map(function ($task) {
                return [
                    $task->id,
                    $task->title,
                    $task->status,
                    $task->due_date,
                ];
            })
        );
    }
}
