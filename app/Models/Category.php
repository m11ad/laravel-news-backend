<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Specify the table name for the model
    protected $table = 'categories';

    // Specify the fillable fields for the model
    protected $fillable = [
        'name',
    ];

    // Define the relationship for the model
    public function newsItems()
    {
        return $this->hasMany(NewsItem::class);
    }
}
