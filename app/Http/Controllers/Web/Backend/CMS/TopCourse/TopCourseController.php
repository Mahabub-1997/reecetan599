<?php

namespace App\Http\Controllers\Web\Backend\CMS\TopCourse;

use App\Http\Controllers\Controller;
use App\Models\TopCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TopCourseController extends Controller
{
    public function index() {
        $topCourses = TopCourse::latest()->paginate(10);
        return view('backend.layouts.top_course.list', compact('topCourses'));
    }

    public function create() {
        return view('backend.layouts.top_course.add');
    }
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'description' => 'nullable|string',
        ]);

        $data = $request->only('title','subtitle','description');

        if($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('top_courses', 'public');
        }

        TopCourse::create($data);

        return redirect()->route('top-course.index')->with('success', 'Top Course created successfully.');
    }

    public function edit(TopCourse $topCourse) {
        return view('backend.layouts.top_course.edit', compact('topCourse'));
    }
    public function update(Request $request, TopCourse $topCourse) {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'description' => 'nullable|string',
        ]);

        $data = $request->only('title','subtitle','description');

        if($request->hasFile('image')) {
            // delete old image if exists
            if($topCourse->image) Storage::disk('public')->delete($topCourse->image);
            $data['image'] = $request->file('image')->store('top_courses', 'public');
        }

        $topCourse->update($data);
//           return $data;
        return redirect()->route('top-course.index', $topCourse->id)->with('success', 'Top Course updated successfully.');
    }

    public function destroy(TopCourse $topCourse) {
        // Delete image if exists
        if($topCourse->image) {
            Storage::disk('public')->delete($topCourse->image);
        }

        // Delete the record
        $topCourse->delete();

        // Redirect to list page with success message
        return redirect()->route('top-course.index')
            ->with('success', 'Top Course deleted successfully.');
    }


}
