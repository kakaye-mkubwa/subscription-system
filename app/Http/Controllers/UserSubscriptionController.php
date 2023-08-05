<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserSubscriptionRequest;
use App\Models\UserSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserSubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // list all
        $userSubscriptions = UserSubscription::with(['user','subscriptionWebsite'])->get();

        // return response
        return response()->json([
            "success" => true,
            "message" => "UserSubscriptions retrieved successfully.",
            "data" => $userSubscriptions
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserSubscriptionRequest $request)
    {
        $validated = $request->validated();

        $validated['created_by'] = auth()->user()->id;

        try {
            $userSubscription = null;
            DB::transaction(function () use ($validated, &$userSubscription) {
                $userSubscription = UserSubscription::create($validated);

                $userSubscription->invoice()->create([
                    'amount' => $userSubscription->subscriptionWebsite->price,
                    'issue_date' => now(),
                    'due_date' => now()->addDays(7),
                    'created_by' => auth()->user()->id
                ]);
            });

            if ($userSubscription){
                $userSubscription->load(['user','subscriptionWebsite']);
                // return response
                return response()->json([
                    "success" => true,
                    "message" => "UserSubscription created successfully.",
                    "data" => $userSubscription
                ],201);
            }else{
                Log::error("Failed to create UserSubscription for : ".auth()->user()->id." with data : ".json_encode($validated));
                return response()->json([
                    "success" => false,
                    "message" => "Failed to create UserSubscription.",
                    "data" => []
                ],500);
            }
        }catch (\Exception $e){
            Log::error("Failed to create UserSubscription for : ".auth()->user()->id." with data : ".json_encode($validated));
            Log::error($e->getMessage());
            return response()->json([
                "success" => false,
                "message" => "Failed to create UserSubscription.",
                "data" => []
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(UserSubscription $userSubscription)
    {
        $userSubscription->load(['user','subscriptionWebsite']);
        return response()->json([
            "success" => true,
            "message" => "UserSubscription retrieved successfully.",
            "data" => $userSubscription
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserSubscriptionRequest $request, UserSubscription $userSubscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserSubscription $userSubscription)
    {
        //
        if ($userSubscription->delete()){
            return response()->json([
                "success" => true,
                "message" => "UserSubscription deleted successfully.",
                "data" => []
            ],200);
        }else{
            return response()->json([
                "success" => false,
                "message" => "Failed to delete UserSubscription.",
                "data" => []
            ],500);
        }
    }
}
