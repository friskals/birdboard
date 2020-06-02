<?php

namespace Tests\Feature;

use App\Project;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function guest_cannot_create_projects()
    {
        $attribute = factory(Project::class)->raw();
        $this->post(route('projects'), $attribute)->assertRedirect('login');
    }

    /** @test */
    public function guest_cannot_view_projects()
    {
        $attribute = factory(Project::class)->raw();
        $this->post(route('projects'), $attribute)->assertRedirect('login');
    }
    /** @test */
    public function guest_cannot_view_single_project()
    {
        $project = factory(Project::class)->create();
        $this->get($project->path())->assertRedirect('login');
    }
    /** @test */
    public function a_project_require_an_owner()
    {
        $attribute = factory(Project::class)->raw(['owner_id' => '']);
        //   $this->post(route('projects.store'), $attribute)->assertSessionHasErrors('owner_id');
        $this->post(route('projects.store'), $attribute)->assertRedirect('login');
    }
    /** @test */
    public function a_user_can_create_a_project()
    {
        // $this->withoutExceptionHandling();
        $this->be(factory(User::class)->create());

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];

        $this->post(route('projects'), $attributes);

        $this->assertDatabaseHas('projects', $attributes);

        $this->get(route('projects'))->assertSee($attributes['title']);
    }
    /** @test */
    public function a_project_require_a_title()
    {
        $this->be(factory(User::class)->create());

        $attribute = factory(Project::class)->raw(['title' => '']);

        $this->post(route('projects.store'), $attribute)->assertSessionHasErrors('title');
    }
    /** @test */
    public function a_project_require_a_description()
    {
        $this->be(factory(User::class)->create());

        $attribute = factory(Project::class)->raw(['description' => '']);

        $this->post(route('projects.store'), $attribute)->assertSessionHasErrors('description');
    }
    /** @test */
    public function a_user_can_view_their_project()
    {
        $this->be(factory(User::class)->create());


        $project =  factory(Project::class)->create(['owner_id' => auth()->id()]);

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }
    /** @test */
    public function an_authenticated_user_cannot_view_others()
    {
        $this->be(factory(User::class)->create());

        $project =  factory(Project::class)->create();

        $this->get($project->path())->assertStatus(403);
    }
}
