<?php

namespace Tests\Feature;

use App\Http\Livewire\StatusFilter;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class StatusFiltersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index_page_contains_status_filters_livewire_component()
    {
        $user = User::factory()->create();

        $category = Category::factory()->create(['name' => 'Category 1']);

        $status = Status::factory()->create([
            'id' => 1,
            'name' => 'Open'
        ]);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My First Idea',
            'category_id' => $category->id,
            'status_id' => $status->id,
            'description' => 'Description of my first idea',
        ]);

        $this->get(route('idea.index'))
        ->assertSeeLivewire('status-filter');

    }

    /** @test */
    public function show_page_contains_status_filters_livewire_component()
    {
        $user = User::factory()->create();

        $category = Category::factory()->create(['name' => 'Category 1']);

        $status = Status::factory()->create([
            'id' => 1,
            'name' => 'Open'
        ]);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My First Idea',
            'category_id' => $category->id,
            'status_id' => $status->id,
            'description' => 'Description of my first idea',
        ]);

        $this->get(route('idea.show', $idea))
        ->assertSeeLivewire('status-filter');

    }

    /** @test */
    public function shows_correct_status_count()
    {
        $user = User::factory()->create();

        $category = Category::factory()->create(['name' => 'Category 1']);

        $statusImplemented = Status::factory()->create([
            'id' => 4,
            'name' => 'Implemented'
        ]);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My First Idea',
            'category_id' => $category->id,
            'status_id' => $statusImplemented->id,
            'description' => 'Description of my first idea',
        ]);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My First Idea',
            'category_id' => $category->id,
            'status_id' => $statusImplemented->id,
            'description' => 'Description of my first idea',
        ]);

        Livewire::test(StatusFilter::class)
        ->assertSee('All Ideas (2)')
        ->assertSee('Implemented (2)');

    }

    /** @test */
    public function filtering_works_when_query_string_in_place()
    {
        $user = User::factory()->create();

        $category = Category::factory()->create(['name' => 'Category 1']);

        $statusOpen = Status::factory()->create(['name' => 'Open']);
        $statusConsidering = Status::factory()->create(['name' => 'Considering']);
        $statusInProgress = Status::factory()->create(['name' => 'In Progress']);
        $statusImplemented = Status::factory()->create(['name' => 'Implemented']);
        $statusClosed = Status::factory()->create(['name' => 'Closed']);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusConsidering->id,
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusConsidering->id,
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusInProgress->id,
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusInProgress->id,
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusInProgress->id,
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusInProgress->id,
        ]);

        $response = $this->get(route('idea.index', ['status'=>'In Progress']));
        $response->assertSuccessful();

        $response->assertSee('<div class="in-progress text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">In Progress</div>',false);
        $response->assertDontSee('<div class="considering text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">Considering</div>',false);
    }

    /** @test */
    public function show_page_does_not_show_selected_status()
    {
        $user = User::factory()->create();

        $category = Category::factory()->create(['name' => 'Category 1']);

        $statusImplemented = Status::factory()->create([
            'id' => 4,
            'name' => 'Implemented'
        ]);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My First Idea',
            'category_id' => $category->id,
            'status_id' => $statusImplemented->id,
            'description' => 'Description of my first idea',
        ]);

        $response = $this->get(route('idea.show', $idea));

        $response->assertDontSee('border-blue text-gray-900');
    }

    /** @test */
    public function index_page_shows_selected_status()
    {
        $user = User::factory()->create();

        $category = Category::factory()->create(['name' => 'Category 1']);

        $statusImplemented = Status::factory()->create([
            'id' => 4,
            'name' => 'Implemented'
        ]);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My First Idea',
            'category_id' => $category->id,
            'status_id' => $statusImplemented->id,
            'description' => 'Description of my first idea',
        ]);

        $response = $this->get(route('idea.index'));

        $response->assertSee('border-blue text-gray-900');
    }

}
