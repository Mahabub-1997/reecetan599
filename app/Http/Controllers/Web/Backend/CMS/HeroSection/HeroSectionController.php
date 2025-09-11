<?php

namespace App\Http\Controllers\Web\Backend\CMS\HeroSection;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSectionController extends Controller
{
    public function index()
    {
        $heroSections = HeroSection::latest()->paginate(10);
        return view('backend.layouts.hero_sections.list', compact('heroSections'));
    }
    public function create()
    {
        return view('backend.layouts.hero_sections.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048', // max 2MB
        ]);

        $data = $request->only(['title', 'description']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('hero-sections', 'public');
        }

        HeroSection::create($data);

        return redirect()->route('hero-sections.index')->with('success', 'Hero Section created successfully.');
    }
    public function edit(HeroSection $heroSection)
    {
        return view('backend.layouts.hero_sections.edit', compact('heroSection'));
    }
    public function update(Request $request, HeroSection $heroSection)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title', 'description']);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($heroSection->image && Storage::disk('public')->exists($heroSection->image)) {
                Storage::disk('public')->delete($heroSection->image);
            }

            $data['image'] = $request->file('image')->store('hero-sections', 'public');
        }

        $heroSection->update($data);

        return redirect()->route('hero-sections.index')->with('success', 'Hero Section updated successfully.');
    }
    public function destroy(HeroSection $heroSection)
    {
        // Delete image if exists
        if ($heroSection->image && Storage::disk('public')->exists($heroSection->image)) {
            Storage::disk('public')->delete($heroSection->image);
        }

        $heroSection->delete();

        return redirect()->route('hero-sections.index')->with('success', 'Hero Section deleted successfully.');
    }

}
