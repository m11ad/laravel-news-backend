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
    use   WithFaker;

    public function test_store_news_item()
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

    public function test_update_news_item()
    {
        // Create a news item and a tag
        $newsItem = NewsItem::create([
            'title' => 'News title',
            'body' => 'News body',
            'category_id' => 1,
            'url' => 'http://example.com/article/123',
        ]);
        $tag = Tag::create([
            'name' => 'Tag name',
        ]);
    
        // Attach the tag to the news item
        $newsItem->tags()->attach($tag);
    
        // Update the news item
        $response = $this->patchJson("/api/news/{$newsItem->id}", [
            'title' => 'Updated news title',
            'body' => 'Updated news body',
            'category_id' => 2,
            'url' => 'http://example.com/article/123',
            'tags' => [$tag->id],
        ]);
    
        // Assert that the news item was updated successfully
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);
    }
}

