<?php

namespace App\Http\Controllers\Web\Backend\CMS\HeroSection;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;

class HeroSectionController extends Controller
{
    public function index()
    {
        $heroSections = HeroSection::latest()->paginate(10);
        return view('backend.layouts.hero_sections.list', compact('heroSections'));
    }
}
