<?php

namespace App\Http\Controllers\Web\Backend\CMS\Subscription;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

    public function index()
    {
        $subscriptions = Subscription::latest()->paginate(10);
        return view('backend.layouts.subscriptions.list', compact('subscriptions'));
    }
    public function create(){
        return view('backend.layouts.subscriptions.add');
    }
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'email' => 'required|email|unique:subscriptions,email',
        ]);

        // Create subscription
        Subscription::create([
            'email' => $request->email,
        ]);

        // Redirect with success message
        return redirect()->route('subscriptions.index')->with('success', 'Subscription added successfully.');
    }

    public function edit(Subscription $subscription)
    {
        return view('backend.layouts.subscriptions.edit', compact('subscription'));
    }

    public function update(Request $request, Subscription $subscription)
    {
        // Validate the email
        $request->validate([
            'email' => 'required|email|unique:subscriptions,email,' . $subscription->id,
        ]);

        // Update subscription
        $subscription->update([
            'email' => $request->email,
        ]);

        // Redirect with success message
        return redirect()->route('subscriptions.index')->with('success', 'Subscription updated successfully.');
    }
    public function destroy(Subscription $subscription)
    {
        // Delete the subscription
        $subscription->delete();

        // Redirect with success message
        return redirect()->route('subscriptions.index')->with('success', 'Subscription deleted successfully.');
    }
}
