<?php


namespace Filters;

use App\Http\Livewire\IdeasIndex;
use App\Models\Category;
use App\Models\Idea;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SearchFilterTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function searching_works_when_more_than_3_characters_in_search_bar()
    {

        $ideaOne = Idea::factory()->create([
            'title' => 'My First Idea',
        ]);

        $ideaTwo = Idea::factory()->create([
            'title' => 'My Second Idea',
        ]);

        $ideaThree = Idea::factory()->create([
            'title' => 'My Third Idea',
        ]);

        Livewire::test(IdeasIndex::class)
            ->set('search', 'Second')
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() === 1
                    && $ideas->first()->title === 'My Second Idea';
            });
    }

    /** @test */
    public function does_not_perform_search_if_less_than_3_characters_in_search_bar()
    {

        $ideaOne = Idea::factory()->create([
            'title' => 'My First Idea',
        ]);

        $ideaTwo = Idea::factory()->create([
            'title' => 'My Second Idea',
        ]);

        $ideaThree = Idea::factory()->create([
            'title' => 'My Third Idea',
        ]);

        Livewire::test(IdeasIndex::class)
            ->set('search', 'ab')
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() === 3;
            });
    }

    /** @test */
    public function search_works_correctly_with_category_filters()
    {
        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        $categoryTwo = Category::factory()->create(['name' => 'Category 2']);

        $ideaOne = Idea::factory()->create([
            'title' => 'My First Idea',
            'category_id' => $categoryOne->id,
        ]);

        $ideaTwo = Idea::factory()->create([
            'title' => 'My Second Idea',
            'category_id' => $categoryOne->id,
        ]);

        $ideaThree = Idea::factory()->create([
            'title' => 'My Third Idea',
            'category_id' => $categoryTwo->id,
        ]);


        Livewire::test(IdeasIndex::class)
            ->set('search', 'idea')
            ->set('category', 'Category 1')
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() === 2;
            });
    }
}
