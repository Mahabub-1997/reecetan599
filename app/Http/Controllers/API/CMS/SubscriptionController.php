<?php

namespace App\Http\Controllers\API\CMS;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Subscription::all(), 200);
    }
    // Store a new subscription
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscriptions,email',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $subscription = Subscription::create([
            'email' => $request->email,
        ]);

        return response()->json($subscription, 201);
    }

    // Show single subscription
    public function show($id)
    {
        $subscription = Subscription::find($id);
        if (!$subscription) {
            return response()->json(['message' => 'Subscription not found'], 404);
        }

        return response()->json($subscription, 200);
    }

    // Update subscription
    public function update(Request $request, $id)
    {
        $subscription = Subscription::find($id);
        if (!$subscription) {
            return response()->json(['message' => 'Subscription not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscriptions,email,' . $subscription->id,
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $subscription->update([
            'email' => $request->email,
        ]);

        return response()->json($subscription, 200);
    }

    // Delete subscription
    public function destroy($id)
    {
        $subscription = Subscription::find($id);
        if (!$subscription) {
            return response()->json(['message' => 'Subscription not found'], 404);
        }
        $subscription->delete();
        return response()->json(['message' => 'Subscription deleted successfully'], 200);
    }
}
