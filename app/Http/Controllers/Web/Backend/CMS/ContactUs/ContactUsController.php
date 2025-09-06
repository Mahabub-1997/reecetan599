<?php

namespace App\Http\Controllers\Web\Backend\CMS\ContactUs;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactUsController extends Controller
{
    // List all
    public function index()
    {
        $contacts = ContactUs::latest()->paginate(10);
        return view('backend.layouts.contact_us.list', compact('contacts'));
    }
    public function create()
    {
        return view('backend.layouts.contact_us.add');
    }
    // Store new contact
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:contact_us,email',
            'contact_number' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'address' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('contact_images', 'public');
        }

        ContactUs::create($data);

        return redirect()->route('contactus.index')->with('success', 'Contact added successfully!');
    }
    // Show edit form
    public function edit($id)
    {
        // Fetch the record from database
        $contact = ContactUs::findOrFail($id);

        // Pass it to the view
        return view('backend.layouts.contact_us.edit', compact('contact'));
    }
    public function update(Request $request, $id)
    {
        $contact = ContactUs::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:contact_us,email,' . $contact->id,
            'contact_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $contact->fill($validatedData);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($contact->image) {
                Storage::disk('public')->delete($contact->image);
            }
            $contact->image = $request->file('image')->store('contact-us', 'public');
        }

        $contact->save();

        return redirect()->route('contactus.index')->with('message', 'Contact updated successfully!');
    }
    public function destroy($id)
    {
        // Find the contact record
        $contact = ContactUs::findOrFail($id);

        // Delete image from storage if exists
        if ($contact->image) {
            Storage::disk('public')->delete($contact->image);
        }

        // Delete the record
        $contact->delete();

        // Redirect back with success message
        return redirect()->route('contactus.index')->with('message', 'Contact deleted successfully!');
    }
}
