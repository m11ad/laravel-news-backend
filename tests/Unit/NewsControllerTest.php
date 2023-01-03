<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Tag;
use App\Models\NewsItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsControllerTest extends TestCase
{
    use  RefreshDatabase, WithFaker;

    public function testStore()
    {
        // Create a new tag
$tag = Tag::create([
    'name' => 'Tag name'
]);

// Create a new category
$category = Category::create([
    'name' => 'Category name'
]);

// Use the created data to test the store method
$response = $this->postJson('/api/news', [
    'title' => 'News title Test',
    'body' => 'News body',
    'category_id' => $category->id,
    'url' => 'http://example.com/article/123',
    'tags' => [$tag->id]
]);

$response
    ->assertStatus(201)
    ->assertJson([
        'message' => 'News item created successfully'
        ]);
    }
}
