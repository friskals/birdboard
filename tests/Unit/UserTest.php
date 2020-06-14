<?php

namespace Tests\Unit;

use App\User;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_user_has_project()
    {
        $user = factory(User::class)->create();

        $this->assertInstanceOf(Collection::class, $user->projects);
    }

    /** @test */
    public function a_user_has_accessible_project()
    {
        $john = $this->signIn();

        ProjectFactory::ownedBy($john)->create();

        $this->assertCount(1, $john->accessibleProjects());

        $sally = factory(User::class)->create();

        $nick = factory(User::class)->create();

        $sallyProject = ProjectFactory::ownedBy($sally)->create();

        $sallyProject->invite($nick);

        $sallyProject->invite($john);


        $this->assertCount(1, $nick->accessibleProjects());

        $this->assertCount(2, $john->accessibleProjects());
    }
}
