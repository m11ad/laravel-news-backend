<?php

namespace Tests\Feature;

use App\Models\NewsItem;
use Tests\TestCase;

class NewsControllerTest extends TestCase
{

    public function testStore()
    {
        // Given
        $data = [
            'title' => 'Test News Item',
            'body' => 'This is the content of the test news item.',
            'url' => 'http://example.com/test-news-item',
        ];

        // When
        $response = $this->postJson(route('news.store'), $data);
        // Then
        $response->assertStatus(201);
        $this->assertDatabaseHas('news_items', [
            'title' => 'Test News Item',
            'body' => 'This is the content of the test news item.',
            'url' => 'http://example.com/test-news-item',
        ]);
    }
}
