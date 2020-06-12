<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Project extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    public $old = [];

    public function path()
    {
        return route('projects.show', $this->id);
    }
    public function owner()
    {
        return $this->belongsTo(User::class);
    }
    public function  tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function addtask($body)
    {
        return $this->tasks()->create(compact('body'));
    }
    public function activity()
    {
        return $this->hasMany(Activity::class)->latest();
    }

    public function activityChanges()
    {
        if ($this->wasChanged()) {
            return [
                'before' => array_diff($this->old, $this->getAttributes()),
                'after' => $this->getChanges()
            ];
        }
    }
}
