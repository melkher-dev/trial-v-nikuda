<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\BrandRequest;
use App\Http\Requests\BrandUpdateRequest;
use Symfony\Component\HttpFoundation\Response;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brand = Brand::paginate(10);

        return response()->json($brand, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        $brand = Brand::create([
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
        ]);

        return response($brand, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $brand = Brand::find($id);

        return response($brand, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandUpdateRequest $request, string $id)
    {
        $brand = Brand::find($id);

        $brand->update([
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
        ]);

        return response($brand, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Brand::destroy($id);

        return response()->json([
            'message' => 'Brand deleted successfully',
        ]);
    }
}
