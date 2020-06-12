<?php

namespace Tests\Feature;

use App\Project;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_task_can_be_updated()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->be($project->owner)->patch($project->tasks->first()->path(), [
            'body' => 'changed'
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
        ]);
    }
    /** @test */
    public function a_task_can_be_completed()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->be($project->owner)->patch($project->tasks->first()->path(), [
            'body' => 'changed',
            'completed' => true
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => true
        ]);
    }

    /** @test */
    public function a_task_can_be_marked_as_incompleted()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::withTasks(1)->create();

        $this->be($project->owner)->patch($project->tasks->first()->path(), [
            'body' => 'changed',
            'completed' => true
        ]);

        $this->patch($project->tasks->first()->path(), [
            'body' => 'changed',
            'completed' => false
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => false
        ]);
    }



    /** @test */
    public function guests_cannot_add_tasks_to_projects()
    {
        $project = ProjectFactory::withTasks(0)->create();

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
    public function only_the_owner_of_the_project_may_update_task()
    {
        $this->signIn();

        $project = ProjectFactory::withTasks(1)->create();

        $this->patch($project->tasks->first()->path(), ['body' => 'My task'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'My task']);
    }
    /** @test */
    public function a_project_can_have_task()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::create();

        $this->be($project->owner)
            ->post($project->path() . '/tasks', ['body' => 'This is task']);

        $this->get($project->path())
            ->assertSee('This is task');
    }
    /** @test */
    public function a_task_require_a_body()
    {
        $project = ProjectFactory::create();

        $attribute = factory(Task::class)->raw(['body' => '']);

        $this->be($project->owner)->post($project->path() . '/tasks', $attribute)->assertSessionHasErrors('body');
    }
}
//projects/id/task