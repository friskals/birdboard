<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    protected $touches = ['project'];

    protected $casts = [
        'completed' => 'boolean'
    ];

    public $old = [];


    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function path()
    {
        return "/projects/{$this->project->id}/tasks/{$this->id}";
    }
    public function complete()
    {
        $this->update(['completed' => true]);

        $this->recordActivity('completed_task');
    }
    public function incomplete()
    {
        $this->update(['completed' => false]);

        $this->recordActivity('incompleted_task');
    }

    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject')->latest();
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
