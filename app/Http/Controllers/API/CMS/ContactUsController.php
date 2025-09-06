<?php

namespace App\Http\Controllers\API\CMS;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactUsController extends Controller
{
    // GET /api/contact-us
    public function index()
    {
        return  ContactUs::all();
    }

    // POST /api/contact-us

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name'           => 'required|string|max:255',
                'email'          => 'required|email|unique:contact_us,email',
                'contact_number' => 'nullable|string|max:20',
                'image'          => 'nullable',
                'address'        => 'nullable|string',
                'description'    => 'nullable|string',
            ]);

            if ($request->hasFile('image')) {
                $validatedData['image'] = $request->file('image')->store('contact_us', 'public');
            }

            $contact = ContactUs::create($validatedData);

            return response()->json([
                'success' => true,
                'data' => $contact
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

    // GET /api/contact-us/{id}
    public function show($id)
    {
        $contact = ContactUs::findOrFail($id);
        return response()->json($contact);
    }


    // PUT/PATCH /api/contact-us/{id}
    public function update(Request $request, $id)
    {
        try {
            $contact = ContactUs::findOrFail($id);

            $validatedData = $request->validate([
                'name'           => 'sometimes|required|string|max:255',
                'email'          => 'sometimes|required|email|unique:contact_us,email,' . $id,
                'contact_number' => 'sometimes|nullable|string|max:20',
                'image'          => 'sometimes|nullable',
                'address'        => 'sometimes|nullable|string',
                'description'    => 'sometimes|nullable|string',
            ]);

            // Handle image upload if provided
            if ($request->hasFile('image')) {
                if ($contact->image && \Storage::disk('public')->exists($contact->image)) {
                    \Storage::disk('public')->delete($contact->image);
                }
                $validatedData['image'] = $request->file('image')->store('contact_us', 'public');
            }

            $contact->update($validatedData);

            return response()->json([
                'success' => true,
                'data' => $contact
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
            ], 422);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Contact not found.',
            ], 404);

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

            // Delete image if exists
            if ($contact->image) {
                Storage::disk('public')->delete($contact->image);
            }

            // Delete the record
            $contact->delete();

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Contact has been deleted successfully.'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete contact: ' . $e->getMessage()
            ], 500);
        }
    }
}
