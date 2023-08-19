<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function taskLists()
    {
        return $this->belongsToMany(TaskList::class, "users_tasks");
    }
}
