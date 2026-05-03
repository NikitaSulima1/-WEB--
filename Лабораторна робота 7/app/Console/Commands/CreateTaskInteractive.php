<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;

class CreateTaskInteractive extends Command
{
    protected $signature = 'tasks:create-interactive';

    protected $description = 'Create task interactively';

    public function handle()
    {
        $title = $this->ask('Введіть назву задачі');
        $description = $this->ask('Короткий опис (необов\'язково)');
        $dueDate = $this->ask('Дата дедлайну (YYYY-MM-DD)');
        $status = $this->choice('Оберіть статус', ['new', 'in_progress', 'done'], 0);
        $assignee = $this->ask('ID виконавця (або залиште порожнім)');

        if (!$this->confirm('Створити цю задачу?', true)) {
            $this->warn('Скасовано');
            return;
        }

        $task = Task::create([
            'title' => $title,
            'description' => $description,
            'status' => $status,
            'project_id' => 1, // можна змінити або запитати окремо
            'author_id' => 1,  // можна прив’язати до auth
            'assigned_to' => $assignee ?: null,
            'due_date' => $dueDate,
        ]);

        $this->info("Задача '{$task->title}' створена з ID: {$task->id}");
    }
}
