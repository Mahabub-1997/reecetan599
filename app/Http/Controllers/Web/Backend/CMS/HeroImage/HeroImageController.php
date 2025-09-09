<?php

namespace App\Http\Controllers\Web\Backend\CMS\HeroImage;

use App\Http\Controllers\Controller;
use App\Models\HeroImage;
use Illuminate\Http\Request;

class HeroImageController extends Controller
{
    public function index()
    {
        $heroImages = HeroImage::latest()->paginate(10);
        return view('backend.layouts.hero_images.list', compact('heroImages'));
    }


    public function create()
    {
        return view('backend.layouts.hero_images.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'images' => 'required|array|max:10',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $paths = [];
        foreach ($request->file('images') as $file) {
            $paths[] = $file->store('hero_images', 'public');
        }

        HeroImage::create(['images' => $paths]);

        return redirect()->route('hero-images.index')->with('success', 'Images uploaded successfully.');
    }
    public function edit(HeroImage $heroImage)
    {
        return view('backend.layouts.hero_images.edit', compact('heroImage'));
    }
    public function update(Request $request, HeroImage $heroImage)
    {
        $request->validate([
            'images' => 'nullable|array|max:10',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        if ($request->hasFile('images')) {
            // Delete old images
            foreach ($heroImage->images as $oldImage) {
                if (file_exists(storage_path('app/public/'.$oldImage))) {
                    unlink(storage_path('app/public/'.$oldImage));
                }
            }

            $paths = [];
            foreach ($request->file('images') as $file) {
                $paths[] = $file->store('hero_images', 'public');
            }

            $heroImage->update(['images' => $paths]);
        }

        return redirect()->route('hero-images.index')->with('success', 'Hero images updated successfully.');
    }
    public function destroy(HeroImage $heroImage)
    {
        foreach ($heroImage->images as $img) {
            if (file_exists(storage_path('app/public/'.$img))) {
                unlink(storage_path('app/public/'.$img));
            }
        }

        $heroImage->delete();

        return redirect()->route('hero-images.index')->with('success', 'Hero images deleted successfully.');
    }


}
