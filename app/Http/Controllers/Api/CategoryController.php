<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // 1. LIST ALL CATEGORIES
   public function index()
{
    $categories = Category::all()->map(function ($category) {
        return [
            'id' => $category->id,
            'name' => $category->name,
            'description' => $category->description,
        ];
    });

    return response()->json([
        'message' => 'Categories retrieved successfully',
        'data' => $categories
    ]);
}

    // 2. CREATE CATEGORY
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255'
        ]);

        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json([
            'message' => 'Category created successfully',
            'data' => [
                'id' => $category->id,
                'name' => $category->name,
                'description' => $category->description
            ]
        ], 201);
    }


    // 4. UPDATE CATEGORY
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'message' => 'Category not found'
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255'
        ]);

        $category->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json([
            'message' => 'Category updated successfully',
            'data' => [
                'id' => $category->id,
                'name' => $category->name,
                'description' => $category->description
            ]
        ]);
    }

    // 5. DELETE CATEGORY
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'message' => 'Category not found'
            ], 404);
        }

        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully'
        ]);
    }
}