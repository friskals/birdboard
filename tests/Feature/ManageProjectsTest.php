<?php

namespace Tests\Feature;

use App\Project;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;

use Tests\TestCase;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function guest_cannot_control_projects()
    {

        $project = factory(Project::class)->create();

        $this->get(route('projects'))->assertRedirect('login');

        $this->get($project->path())->assertRedirect('login');

        $this->get($project->path() . '/edit')->assertRedirect('login');


        $this->post(route('projects'), $project->toArray())->assertRedirect('login');
    }

    /** @test */
    public function a_project_require_an_owner()
    {
        $attribute = factory(Project::class)->raw(['owner_id' => '']);
        //   $this->post(route('projects.store'), $attribute)->assertSessionHasErrors('owner_id');
        $this->post(route('projects'), $attribute)->assertRedirect('login');
    }

    /** @test */
    public function a_user_can_create_a_project()
    {
        $this->signIn();

        $this->get(route('projects.create'))->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence(1),
            'notes'  => 'notes'
        ];


        $response = $this->post(route('projects'), $attributes);

        $project = Project::where($attributes)->first();

        $response->assertRedirect($project->path());

        $this->assertDatabaseHas('projects', $attributes);

        $this->get($project->path())

            ->assertSee($attributes['title'])
            ->assertSee($attributes['description'])
            ->assertSee($attributes['notes']);
    }

    /** @test */
    public function a_user_can_update_their_project()
    {
        $project = ProjectFactory::create();

        $this->be($project->owner)
            ->patch($project->path(), $attributes = ['title' => 'Changed', 'description' => 'changed', 'notes' => 'Changed'])
            ->assertRedirect($project->path());

        $this->assertDatabaseHas('projects', $attributes);
    }
    /** @test */
    public function a_user_can_update_their_project_general_notes()
    {
        $project = ProjectFactory::create();

        $this->be($project->owner)
            ->patch($project->path(), $attributes = ['notes' => 'Changed']);

        $this->assertDatabaseHas('projects', $attributes);
    }
    /** @test */
    public function a_user_can_view_their_project()
    {
        $project = ProjectFactory::create();

        $this->be($project->owner)
            ->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    /** @test */
    public function a_project_require_a_title()
    {
        $this->signIn();

        $attribute = factory(Project::class)->raw(['title' => '']);

        $this->post(route('projects'), $attribute)->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_project_require_a_description()
    {
        $this->signIn();

        $attribute = factory(Project::class)->raw(['description' => '']);

        $this->post(route('projects'), $attribute)->assertSessionHasErrors('description');
    }

    /** @test */
    public function an_authenticated_user_cannot_view_others_project()
    {
        $this->signIn();

        $project =  factory(Project::class)->create();

        $this->get($project->path())->assertStatus(403);
    }
    /** @test */
    public function an_authenticated_user_cannot_update_others_project()
    {
        $this->signIn();

        $project =  factory(Project::class)->create();

        $this->patch($project->path())->assertStatus(403);
    }
}