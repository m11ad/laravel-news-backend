<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\NewsItem;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();

        return response()->json($categories);
    }

    public function show($id)
    {
        $category = Category::find($id);
        $news = NewsItem::where('category_id', $id)->get();

        // Return the category and news items as a JSON response
        return response()->json([
            'category' => $category,
            'news' => $news,
        ]);    }
}
