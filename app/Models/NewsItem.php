<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsItem extends Model
{

    // Specify the table name for the model
    protected $table = 'news_items';

    // Specify the fillable fields for the model
    protected $fillable = [
        'title',
        'body',
        'category_id',
        'url',
    ];

    // Define the relationships for the model
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}