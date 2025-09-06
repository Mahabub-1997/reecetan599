<?php

namespace App\Http\Controllers\API\CMS;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // List all ratings
    public function index()
    {
        $ratings = Rating::with('user')->get();
        return response()->json(['success' => true, 'data' => $ratings], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'rating_point' => 'nullable|integer|min:1|max:5',
            ]);

            $rating = Rating::create($request->only('user_id', 'rating_point'));

            return response()->json([
                'success' => true,
                'message' => 'Rating created successfully',
                'data' => $rating
            ], 201);

        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    // Show a single rating
    public function show($id)
    {
        try {
            $rating = Rating::with('user')->findOrFail($id);
            return response()->json(['success' => true, 'data' => $rating], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Rating not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    // Update a rating
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'rating_point' => 'nullable|integer|min:1|max:5', // now nullable
            ]);

            $rating = Rating::findOrFail($id);
            $rating->update($request->only('user_id', 'rating_point'));

            return response()->json([
                'success' => true,
                'message' => 'Rating updated successfully',
                'data' => $rating
            ], 200);

        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Rating not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $rating = Rating::findOrFail($id);
            $rating->delete();

            return response()->json(['success' => true, 'message' => 'Rating deleted successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Rating not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
