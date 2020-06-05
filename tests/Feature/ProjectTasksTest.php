<?php

namespace Tests\Feature;

use App\Project;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function guests_cannot_add_tasks_to_projects()
    {
        $project = factory(Project::class)->create();
        $this->post($project->path() . '/tasks')->assertRedirect('login');
    }

    /** @test */
    public function only_the_owner_of_the_project_may_add_task()
    {
        $this->signIn();

        $project = factory(Project::class)->create();

        $this->post($project->path() . '/tasks', ['body' => 'My task'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'My task']);
    }
    /** @test */
    public function a_project_can_have_task()
    {
        $this->signIn();

        $this->withoutExceptionHandling();

        $project = auth()->user()->projects()->create(
            factory(Project::class)->raw()
        );

        $this->post($project->path() . '/tasks', ['body' => 'This is task']);

        $this->get($project->path())
            ->assertSee('This is task');
    }
    /** @test */
    public function a_task_require_a_body()
    {
        $this->signIn();

        $project = auth()->user()->projects()->create(
            factory(Project::class)->raw()
        );

        $attribute = factory(Task::class)->raw(['body' => '']);

        $this->post($project->path() . '/tasks', $attribute)->assertSessionHasErrors('body');
    }
}
//projects/id/task