<?php

namespace App\Http\Controllers;

use App\Category;
use App\NewsItem;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    /**
     * Display a listing of the news items.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsItems = NewsItem::with('category', 'tags')->get();

        return view('news.index', compact('newsItems'));
    }

    /**
     * Show the form for creating a new news item.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('news.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created news item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => 'required|max:255',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
            'url' => 'required|url|regex:/\/article\/.*/|not_regex:/\/nl\/article\/.*/|not_regex:/\/[0-9]+\/article\/.*/',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $newsItem = new NewsItem($data);
        $newsItem->save();
        $newsItem->tags()->sync($data['tags']);

        return redirect()->route('news.index');
    }

    /**
     * Display the specified news item.
     *
     * @param  \App\NewsItem  $newsItem
     * @return \Illuminate\Http\Response
     */
    public function show(NewsItem $newsItem)
    {
        $newsItem->load(['category', 'tags']);

        return view('news.show', compact('newsItem'));
    }

    /**
     * Show the form for editing the specified news item.
     *
     * @param  \App\NewsItem  $newsItem
     * @return \Illuminate\Http\Response
     */
    public function edit(NewsItem $newsItem)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('news.edit', compact('newsItem', 'categories', 'tags'));
    }

    /**
     * Update the specified news item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NewsItem  $newsItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NewsItem $newsItem)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => 'required|max:255',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
            'url' => 'required|url|regex:/\/article\/.*/|not_regex:/\/nl\/article\/.*/|not_regex:/\/[0-9]+\/article\/.*/',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $newsItem->fill($data);
        $newsItem->save();
        $newsItem->tags()->sync($data['tags']);

        return redirect()->route('news.index');
    }

    /**
     * Remove the specified news item from storage.
     *
     * @param  \App\NewsItem  $newsItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(NewsItem $newsItem)
    {
        $newsItem->delete();

        return redirect()->route('news.index');
    }
}