<?php

namespace App\Http\Controllers\API\CMS;

use App\Http\Controllers\Controller;
use App\Models\TopCourse;
use Illuminate\Http\Request;

class TopCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topCourses = TopCourse::all();

        return response()->json([
            'success' => true,
            'message' => 'Top courses retrieved successfully.',
            'data' => $topCourses
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $topCourse = TopCourse::create($request->only([
            'title',
            'subtitle',
            'image',
            'description'
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Top course created successfully.',
            'data' => $topCourse
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TopCourse $topCourse)
    {
        return response()->json([
            'success' => true,
            'message' => 'Top course retrieved successfully.',
            'data' => $topCourse
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TopCourse $topCourse)
    {
        $topCourse->update($request->only(['title', 'subtitle', 'image', 'description']));

        return response()->json([
            'success' => true,
            'message' => 'Top course updated successfully.',
            'data' => $topCourse
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TopCourse $topCourse)
    {
        $topCourse->delete();

        return response()->json([
            'success' => true,
            'message' => 'Top course deleted successfully.'
        ], 200);
    }
}
