<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'message' => 'This is the subscribe index endpoint. You can list all subscribers here.'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate the request data
        try {
            $request->validate([
                'email' => 'required|email|unique:subscribers,email',
                'first_name' => 'nullable|string|max:255',
                'last_name' => 'nullable|string|max:255',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        }

        $subscriber = new \App\Models\Subscriber();
        $subscriber->email = $request->email;
        $subscriber->first_name = $request->first_name;
        $subscriber->last_name = $request->last_name;
        $subscriber->save();
        //$subscriberExists = \App\Models\Subscriber::where('email', '=', $request->email)->first();
       
        return response()->json([
            'message' => 'Subscriber created successfully.',
            'data' => $subscriber
        ], 201);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
