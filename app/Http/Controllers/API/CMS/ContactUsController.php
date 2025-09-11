<?php

namespace App\Http\Controllers\API\CMS;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    // GET /api/contact-us
    public function index()
    {
        return response()->json(ContactUs::all(), 200);
    }

    // POST /api/contact-us
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name'        => 'required|string|max:255',
                'email'       => 'required|email|unique:contact_us,email',
                'description' => 'nullable|string',
            ]);

            $contact = ContactUs::create($validatedData);

            return response()->json([
                'success' => true,
                'data'    => $contact
            ], 201);

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

    // GET /api/contact-us/{id}
    public function show($id)
    {
        $contact = ContactUs::findOrFail($id);
        return response()->json($contact, 200);
    }

    // PUT/PATCH /api/contact-us/{id}
    public function update(Request $request, $id)
    {
        try {
            $contact = ContactUs::findOrFail($id);

            $validatedData = $request->validate([
                'name'        => 'sometimes|required|string|max:255',
                'email'       => 'sometimes|required|email|unique:contact_us,email,' . $id,
                'description' => 'sometimes|nullable|string',
            ]);

            $contact->update($validatedData);

            return response()->json([
                'success' => true,
                'data'    => $contact
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors'  => $e->errors(),
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
            $contact->delete();

            return response()->json([
                'success' => true,
                'message' => 'Contact has been deleted successfully.'
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Contact not found.'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete contact: ' . $e->getMessage()
            ], 500);
        }
    }
}
