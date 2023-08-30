<?php

namespace Tests\Feature;

use App\Http\Livewire\SetStatus;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AdminSetStatusTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function show_page_contains_set_status_component_when_user_is_admin()
    {
        $user = User::factory()->create([
            'name' => 'cuu',
            'email' => 'cu@cu.com'
        ]);

        $categoryOne = Category::factory()->create(['name' => 'Category 1']);

        $status = Status::factory()->create([
            'id' => 1,
            'name' => 'Open'
        ]);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My First Idea',
            'category_id' => $categoryOne->id,
            'status_id' => $status->id,
            'description' => 'Description of my first idea',
        ]);

        $this->actingAs($user)
            ->get(route('idea.show', $idea))
            ->assertSeeLivewire('set-status');


    }

    /** @test */
    public function show_page_does_not_contains_set_status_component_when_user_is_not_admin()
    {
        $user = User::factory()->create([
            'name' => 'ffcuu',
            'email' => 'ffcu@cu.com'
        ]);

        $categoryOne = Category::factory()->create(['name' => 'Category 1']);

        $status = Status::factory()->create([
            'id' => 1,
            'name' => 'Open'
        ]);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My First Idea',
            'category_id' => $categoryOne->id,
            'status_id' => $status->id,
            'description' => 'Description of my first idea',
        ]);

        $this->actingAs($user)
            ->get(route('idea.show', $idea))
            ->assertDontSeeLivewire('set-status');
    }


    /** @test */
    public function initial_status_is_set_correctly()
    {
        $user = User::factory()->create([
            'name' => 'cuu',
            'email' => 'cu@cu.com'
        ]);

        $categoryOne = Category::factory()->create(['name' => 'Category 1']);

        $statusConsidering = Status::factory()->create([
            'id' => 2,
            'name' => 'Considering'
        ]);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My First Idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusConsidering->id,
            'description' => 'Description of my first idea',
        ]);

        Livewire::actingAs($user)
            ->test(SetStatus::class, [
                'idea' => $idea,
            ])->assertSet('status', $statusConsidering->id);
    }

    /** @test */
    public function can_set_status_correctly()
    {
        $user = User::factory()->create([
            'name' => 'cuu',
            'email' => 'cu@cu.com'
        ]);

        $categoryOne = Category::factory()->create(['name' => 'Category 1']);

        $statusConsidering = Status::factory()->create([
            'id' => 2,
            'name' => 'Considering'
        ]);

        $statusInProgress = Status::factory()->create([
            'id' => 3,
            'name' => 'In Progress'
        ]);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My First Idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusConsidering->id,
            'description' => 'Description of my first idea',
        ]);

        Livewire::actingAs($user)
            ->test(SetStatus::class, [
                'idea' => $idea,
            ])
            ->set('status', $statusInProgress->id)
            ->call('setStatus')
            ->assertEmitted('statusWasUpdated');

        $this->assertDatabaseHas('ideas', [
            'id' => $idea->id,
            'status_id' => $statusInProgress->id
        ]);
    }
}
