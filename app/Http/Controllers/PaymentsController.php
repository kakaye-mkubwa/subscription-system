<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentsRequest;
use App\Models\Payments;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // list all payments
        $payments = Payments::with(['invoice'])->get();

        // return response
        return response()->json([
            "success" => true,
            "message" => "Payments retrieved successfully.",
            "data" => $payments
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentsRequest $request)
    {
        // validate the request
        $validated = $request->validated();

        $validated['created_by'] = auth()->user()->id;

        // create
        $payments = Payments::create($validated);

        if ($payments){
            $payments->load(['invoice']);
            // return response
            return response()->json([
                "success" => true,
                "message" => "Payments created successfully.",
                "data" => $payments
            ],201);
        }else{
            return response()->json([
                "success" => false,
                "message" => "Failed to create Payments.",
                "data" => []
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Payments $payments)
    {
        // show payments details
        $payments->load(['invoice']);
        return response()->json([
            "success" => true,
            "message" => "Payments retrieved successfully.",
            "data" => $payments
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaymentsRequest $request, Payments $payments)
    {
        // update payments
        $validated = $request->validated();

        $validated['updated_by'] = auth()->user()->id;

        if ($payments->update($validated)){
            $payments->load(['invoice']);
            // return response
            return response()->json([
                "success" => true,
                "message" => "Payments updated successfully.",
                "data" => $payments
            ],200);
        }else{
            return response()->json([
                "success" => false,
                "message" => "Failed to update Payments.",
                "data" => null
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payments $payments)
    {
        // delete payments
        if ($payments->delete()){
            $payments->deleted_by = auth()->user()->id;
            $payments->save();

            // return response
            return response()->json([
                "success" => true,
                "message" => "Payments deleted successfully.",
                "data" => null
            ],200);
        }else{
            return response()->json([
                "success" => false,
                "message" => "Failed to delete Payments.",
                "data" => null
            ],500);
        }
    }
}
