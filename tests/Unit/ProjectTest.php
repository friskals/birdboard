<?php

namespace Tests\Unit;

use App\Project;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /** @test */
    public function it_has_a_path()
    {
        $project = factory(Project::class)->create();

        $this->assertEquals(route('projects.show', $project->id), $project->path());
    }
    /** @test */
    public function it_belongs_to_a_user()
    {
        $project = factory(Project::class)->create();
        $this->assertInstanceOf(User::class, $project->owner);
    }
    /** @test */
    public function it_can_add_task()
    {
        $project = factory(Project::class)->create();
        $task = $project->addTask('This is task');
        $this->assertCount(1, $project->tasks);
        $this->assertTrue($project->tasks->contains($task));
    }
}
