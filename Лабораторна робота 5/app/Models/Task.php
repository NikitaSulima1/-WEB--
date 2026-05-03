<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use App\Models\Comment;
use App\Models\User;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'project_id',
        'author_id',
        'assigned_to',
        'due_date'
    ];

    // Task → Project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Task → Comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Автор задачі
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Призначений користувач
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
