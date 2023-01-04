<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\NewsItem;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return response()->json([
            'categories' => $categories
        ], 200);
    }
    
    public function show($id)
    {
        $category = Category::find($id);
    
        if (!$category) {
            return response()->json([
                'message' => 'Category not found',
            ], 404);
        }
    
        return response()->json([
            'category' => $category
        ], 200);
    }
    
    public function update(Request $request, $id)
    {
        $data = $request->all();
    
        $validator = Validator::make($data, [
            'name' => 'required|max:255',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
    
        $category = Category::find($id);
    
        if (!$category) {
            return response()->json([
                'message' => 'Category not found',
            ], 404);
        }
    
        $category->update($data);
    
        return response()->json([
            'message' => 'Category updated successfully',
            'category' => $category
        ], 200);
    }
    
    public function destroy($id)
    {
        $category = Category::find($id);
    
        if (!$category) {
            return response()->json([
                'message' => 'Category not found',
            ], 404);
        }
    
        $category->delete();
    
        return response()->json([
            'message' => 'Category deleted successfully',
        ], 200);
    }
}
