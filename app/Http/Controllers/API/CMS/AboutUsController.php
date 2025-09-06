<?php

namespace App\Http\Controllers\API\CMS;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutUsController extends Controller
{
    public function index()
    {
        return AboutUs::all();
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'image' => 'nullable',
            ]);

            if ($request->hasFile('image')) {
                $validatedData['image'] = $request->file('image')->store('about-us', 'public');
            }

            $aboutUs = AboutUs::create($validatedData);

            return response()->json([
                'success' => true,
                'data' => $aboutUs
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $aboutUs = AboutUs::findOrFail($id);
        return response()->json($aboutUs);
    }

// PUT/PATCH /api/contact-us/{id}
    public function update(Request $request, $id)
    {
        try {
            $contact = ContactUs::findOrFail($id);

            $validatedData = $request->validate([
                'name'           => 'required|string|max:255',
                'email'          => 'required|email|unique:contact_us,email,' . $contact->id,
                'contact_number' => 'nullable|string|max:20',
                'address'        => 'nullable|string',
                'description'    => 'nullable|string',
                'image'          => 'nullable|file|image|mimes:jpeg,jpg,png,svg|max:2048',
            ]);

            // Handle image upload
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                // Delete old image if exists
                if ($contact->image) {
                    Storage::disk('public')->delete($contact->image);
                }
                $validatedData['image'] = $request->file('image')->store('contact_us', 'public');
            }

            $contact->update($validatedData);

            return response()->json([
                'success' => true,
                'data'    => $contact
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors'  => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    // DELETE /api/contact-us/{id}
    public function destroy($id)
    {
        try {
            $contact = ContactUs::findOrFail($id);

            if ($contact->image) {
                Storage::disk('public')->delete($contact->image);
            }

            $contact->delete();

            return response()->json([
                'success' => true,
                'message' => 'Contact deleted successfully.'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
