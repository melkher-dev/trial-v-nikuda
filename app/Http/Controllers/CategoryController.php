<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);

        return response()->json($categories, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create([
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
        ]);

        return response($category, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);

        return response($category, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, string $id)
    {
        $category = Category::find($id);

        $category->update([
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
        ]);

        return response($category, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::destroy($id);

        return response()->json([
            'message' => 'Category deleted successfully',
        ]);
    }
}
