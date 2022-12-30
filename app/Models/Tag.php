<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // Specify the table name for the model
    protected $table = 'tags';

    // Specify the fillable fields for the model
    protected $fillable = [
        'name',
    ];

    // Define the relationship for the model
    public function newsItems()
    {
        return $this->belongsToMany(NewsItem::class);
    }
}
