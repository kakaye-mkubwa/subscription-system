<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionWebsitesRequest;
use App\Models\SubscriptionWebsites;
use Illuminate\Http\Request;

class SubscriptionWebsitesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // list all
        $subscriptionWebsites = SubscriptionWebsites::all();

        // return response
        return response()->json([
            "success" => true,
            "message" => "SubscriptionWebsites retrieved successfully.",
            "data" => $subscriptionWebsites
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubscriptionWebsitesRequest $request)
    {
        // validate request
        $validated = $request->validated();

        $validated['created_by'] = auth()->user()->id;

        // create
        $subscriptionWebsites = SubscriptionWebsites::create($validated);

        // return response
        return response()->json([
            "success" => true,
            "message" => "SubscriptionWebsites created successfully.",
            "data" => $subscriptionWebsites
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(SubscriptionWebsites $subscriptionWebsites)
    {
        // show details
        return response()->json([
            "success" => true,
            "message" => "SubscriptionWebsites retrieved successfully.",
            "data" => $subscriptionWebsites
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubscriptionWebsites $subscriptionWebsites)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubscriptionWebsites $subscriptionWebsites)
    {
        // delete
        if ($subscriptionWebsites->delete()){
            return response()->json([
                "success" => true,
                "message" => "SubscriptionWebsites deleted successfully.",
                "data" => null
            ],200);
        } else {
            return response()->json([
                "success" => false,
                "message" => "SubscriptionWebsites could not be deleted.",
                "data" => null
            ],500);
        }
    }
}
