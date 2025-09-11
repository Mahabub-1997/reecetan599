<?php

namespace App\Http\Controllers\Api\CMS;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use App\Models\OnlineCourse;
use Illuminate\Http\Request;

class HeroSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // List all hero sections
    public function index()
    {
        return HeroSection::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    // Store hero section
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('hero_images', 'public');
        }

        return HeroSection::create($data);
    }

    /**
     * Display the specified resource.
     */
    // Show a single hero section
    public function show(HeroSection $heroSection)
    {
        return $heroSection;
    }

    /**
     * Update the specified resource in storage.
     */
//    public function update(Request $request, HeroSection $heroSection)
//    {
////        dd($request->all());
//        $request->validate([
//            'title' => 'sometimes|required|string|max:255',
//            'description' => 'nullable|string',
//            'image' => 'nullable|image|max:2048'
//        ]);
////        dd($request->toArray());
//
//        $data = $request->only(['title', 'description', 'image']);
////dd($data);
//        // Handle image update
//        if ($request->hasFile('image')) {
//            // Delete old image if exists
//            if ($heroSection->image && \Storage::disk('public')->exists($heroSection->image)) {
//                \Storage::disk('public')->delete($heroSection->image);
//            }
//
//
//            // Store new image
//            $data['image'] = $request->file('image')->store('hero_images', 'public');
//        }
////        dd($data);
//
//        $heroSection->update($data);
//
//        return response()->json([
//            'message' => 'Hero Section updated successfully',
//            'data' => $heroSection
//        ], 200);
//    }



    public function update(Request $request, HeroSection $heroSection)
    {
        $request->validate([
            'title'       => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Only allow valid fields
        $data = $request->only(['title', 'description']);

        // Handle new image upload
        if ($request->hasFile('image')) {
            // delete old image if exists
            if ($heroSection->image && \Storage::disk('public')->exists($heroSection->image)) {
                \Storage::disk('public')->delete($heroSection->image);
            }

            // store new one
            $path = $request->file('image')->store('hero_images', 'public');
            $data['image'] = $path;
        }

        // update model
        $heroSection->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Hero section updated successfully',
            'data'    => [
                'id'          => $heroSection->id,
                'title'       => $heroSection->title,
                'description' => $heroSection->description,
                'image_url'   => $heroSection->image ? asset('storage/' . $heroSection->image) : null,
            ],
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    // Delete hero section
    public function destroy(HeroSection $heroSection)
    {
        $heroSection->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }


    // Search Online Courses by title or category
    public function searchCourses(Request $request)
    {
        $query = $request->get('query');

        $courses = OnlineCourse::with('category')
            ->where('title', 'LIKE', "%$query%")
            ->orWhereHas('category', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%$query%");
            })
            ->get();

        return $courses;
    }

    public function updateHeroSection(Request $request, $id)
    {
        $heroSection = HeroSection::findOrFail($id);

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title', 'description']);

        if ($request->hasFile('image')) {
            if ($heroSection->image && \Storage::disk('public')->exists($heroSection->image)) {
                \Storage::disk('public')->delete($heroSection->image);
            }
            $data['image'] = $request->file('image')->store('hero_images', 'public');
        }

        $heroSection->update($data);

        return response()->json([
            'message' => 'Hero Section updated successfully',
            'data' => $heroSection
        ], 200);
    }

}
