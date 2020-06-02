<?php

namespace Tests\Feature;

use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();
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
        $attribute = factory(Project::class)->raw(['title' => '']);

        $this->post(route('projects.store'), $attribute)->assertSessionHasErrors('title');
    }
    /** @test */
    public function a_project_require_a_description()
    {
        $attribute = factory(Project::class)->raw(['description' => '']);
        $this->post(route('projects.store'), $attribute)->assertSessionHasErrors('description');
    }
    /** @test */
    public function a_user_can_view_project()
    {
        $this->withoutExceptionHandling();
        $project =  factory(Project::class)->create();
        $this->get(route('projects.show', $project->id))
            ->assertSee($project->title)
            ->assertSee($project->description);
    }
}
