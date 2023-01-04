<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Tag;
use App\Models\NewsItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


// To test all the CRUD functions in the NewsConroller.php
class NewsControllerTest extends TestCase
{
    use   WithFaker;

    public function testStoreNewsItem()
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

    public function testUpdateNewsItem()
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


    public function testDestroyNewsItem()
    {
        // Create a news item in the database
        $newsItem = new NewsItem;
        $newsItem->title = 'Going to be deleted News title';
        $newsItem->body = 'Goiing to be deleted News body';
        $newsItem->category_id = 1;
        $newsItem->url = 'http://example.com/article/123';
        $newsItem->save();

        // Send a DELETE request to the destroy method
        $response = $this->delete('/api/news/' . $newsItem->id);

        // Assert that the response status code is 204 (No Content)
        $response->assertStatus(204);

        // Assert that the news item has been deleted from the database
        $this->assertDatabaseMissing('news_items', [
            'id' => $newsItem->id,
            'title' => 'Going to be deleted News title',
            'body' => 'Going to be deleted News body',
            'category_id' => 1,
            'url' => 'http://example.com/article/123',
        ]);
    }

}

