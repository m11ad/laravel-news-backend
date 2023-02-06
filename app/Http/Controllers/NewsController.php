<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\NewsItem;
use App\Models\Tag;
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

        return response()->json($newsItems);
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
    
        return response()->json($newsItem);
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
            //this validator will fullfill the conditions stated in the exam question


            //title field is required and must not be longer than 255 characters
            'title' => 'required|max:255',

            //the body field is required
            'body' => 'required',

            //the category_id field is required and must be an existing category ID
            'category_id' => 'required|exists:categories,id',


            /* Contains the string /article/ somewhere in it.
            Does not contain the string /nl/article/ anywhere in it.
            Does not contain a string of the form /[0-9]+/article/ anywhere in it. */

            'url' => 'required|url|regex:/\/article\/.*/|not_regex:/\/nl\/article\/.*/|not_regex:/\/article\/[0-9]+.*/',



            //tags field is an array
            'tags' => 'array',

            // tag IDs that must all be existing tags
            'tags.*' => 'exists:tags,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->setStatusCode(400);
        }


        $newsItem = new NewsItem($data);
        $newsItem->save();
        $newsItem->tags()->sync($data['tags']);

        return response()->json([
            'message' => 'News item created successfully',
        ], 201);
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
            //Same validation as the store() method 

            'title' => 'required|max:255',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
            'url' => 'required|url|regex:/\/article\/.*/|not_regex:/\/nl\/article\/.*/|not_regex:/\/article\/[0-9]+.*/',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->setStatusCode(400);
        }

        $newsItem->fill($data);
        $newsItem->save();
        $newsItem->tags()->sync($data['tags']);

        return response()->json(['success' => true]);
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

        return response()->json(['success' => true], 204);
    }
}