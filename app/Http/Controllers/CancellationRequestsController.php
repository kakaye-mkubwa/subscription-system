<?php

namespace App\Http\Controllers;

use App\Http\Requests\CancellationRequest;
use App\Http\Requests\CancellationRequestUpdate;
use App\Models\CancellationRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CancellationRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // list all cancellation requests
        $cancellationRequests = CancellationRequests::with(['subscriptionWebsite','user'])->get();

        // return response
        return response()->json([
            "success" => true,
            "message" => "Cancellation requests retrieved successfully.",
            "data" => $cancellationRequests
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CancellationRequest $request)
    {
        // validate request
        $validated = $request->validated();

        $validated['created_by'] = auth()->user()->id;

        // create
        $cancellationRequests = CancellationRequests::create($validated);

        if ($cancellationRequests){
            $cancellationRequests->load(['subscriptionWebsite','user']);
            // return response
            return response()->json([
                "success" => true,
                "message" => "Cancellation requests created successfully.",
                "data" => $cancellationRequests
            ],201);
        }else{
            return response()->json([
                "success" => false,
                "message" => "Failed to create Cancellation requests.",
                "data" => []
            ],500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CancellationRequestUpdate $request, CancellationRequests $cancellationRequests)
    {
        // validate request
        $validated = $request->validated();

        $validated['updated_by'] = auth()->user()->id;

        if ($cancellationRequests->update($validated)){
            $cancellationRequests->load(['subscriptionWebsite','user']);
            // return response
            return response()->json([
                "success" => true,
                "message" => "Cancellation requests updated successfully.",
                "data" => $cancellationRequests
            ],201);
        }else{
            return response()->json([
                "success" => false,
                "message" => "Failed to update Cancellation requests.",
                "data" => []
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CancellationRequests $cancellationRequests)
    {
        // check if cancellation request is pending
        if ($cancellationRequests->approval_status != 'pending') {
            // delete
            if ($cancellationRequests->delete()) {
                // return response
                return response()->json([
                    "success" => true,
                    "message" => "Cancellation requests deleted successfully.",
                    "data" => []
                ], 200);
            } else {
                Log::error("Failed to delete Cancellation requests for : " . json_encode($cancellationRequests));
                return response()->json([
                    "success" => false,
                    "message" => "Failed to delete Cancellation requests.",
                    "data" => []
                ], 500);
            }
        } else {
            return response()->json([
                "success" => false,
                "message" => "Cancellation requests is pending approval.",
                "data" => []
            ], 422);
        }
    }
}
