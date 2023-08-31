<?php

namespace Tests\Feature;

use App\Http\Livewire\CreateIdea;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Livewire\Response;
use Tests\TestCase;

class CreateIdeaTest extends TestCase
{
    use RefreshDatabase;

    /** @test  */
    public function create_idea_form_does_not_show_when_logged_out(): void
    {
        $response = $this->get(route('idea.index'));

        $response->assertSuccessful();
        $response->assertSee('Please login to create an idea.');
        $response->assertDontSee('Let us know what you would like and we`ll take a look over!');
    }
    /** @test  */
    public function create_idea_form_does_show_when_logged_in(): void
    {
        $response = $this->actingAs(User::factory()->create())->get(route('idea.index'));


        $response->assertSuccessful();
        $response->assertDontSee('Please login to create an idea.');
        $response->assertSee('Let us know what you would like and we`ll take a look over!');
    }

    /** @test */
    public function main_page_contains_create_idea_livewire_component()
    {
        $this->actingAs(User::factory()->create())
            ->get(route('idea.index'))
            ->assertSeeLivewire('create-idea');
    }

    /** @test */
    public function create_idea_form_validation_works()
    {
        Livewire::actingAs(User::factory()->create())
        ->test(CreateIdea::class)
        ->set('title', '')
        ->set('category', '')
        ->set('description', '')
            ->call('createIdea')
        ->assertHasErrors(['title', 'category', 'description'])
        ->assertsee('The title field is required');
    }

    /** @test */
    public function creating_an_idea_works_correctly()
    {
        $user = User::factory()->create([
            'id' => 1
        ]);

        $categoryOne = Category::factory()->create(['name' => 'Category 1']);

        $statusOpen = Status::factory()->create(['name' => 'Open', 'id' => 1]);


        Livewire::actingAs($user)
            ->test(CreateIdea::class)
            ->set('title', 'My First Idea')
            ->set('category', $categoryOne->id)
            ->set('description', 'This is my first idea')
            ->call('createIdea')
            ->assertRedirect('/');

        $ideas = Idea::all();

        $response = $this->actingAs($user)->get(route('idea.index'));
        $response->assertSuccessful();
        $response->assertSee('My First Idea');
        $response->assertSee('This is my first idea');

        $this->assertDatabaseHas('ideas', [
            'title' => 'My First Idea'
        ]);

        $this->assertDatabaseHas('votes', [
            'idea_id' => Idea::find($ideas->last()->id)->id,
            'user_id' => 1,
        ]);
    }

    /** @test */
    public function creating_two_ideas_with_same_title_still_works_but_has_different_slugs()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name'=>'Category 1']);

        Status::factory()->create([
            'id' => 1,
            'name'=>'Open'
        ]);

        Livewire::actingAs($user)
            ->test(CreateIdea::class)
            ->set('title', 'My Second Idea')
            ->set('category', $categoryOne->id)
            ->set('description', 'This is my Second idea')
                ->call('createIdea')
            ->assertRedirect('/');

        Livewire::actingAs($user)
            ->test(CreateIdea::class)
            ->set('title', 'My Second Idea')
            ->set('category', $categoryOne->id)
            ->set('description', 'This is my second idea with Second slug')
            ->call('createIdea')
            ->assertRedirect('/');

        $this->assertDatabaseHas('ideas', [
            'title' => 'My Second Idea',
            'slug' => 'my-second-idea'
        ]);

        $this->assertDatabaseHas('ideas', [
            'title' => 'My Second Idea',
            'slug' => 'my-second-idea-1'
        ]);
    }
}

