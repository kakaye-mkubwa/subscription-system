<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        \request()->validate([
            'perPage' => 'integer|min:1|max:100',
            'page' => 'integer|min:1'
        ]);

        // results per page
        $perPage = htmlspecialchars(stripslashes(trim(request()->get('perPage')))) ?? 10;

        // get page
        $currentPage = htmlspecialchars(stripslashes(trim(request()->get('page')))) ?? 1;

        // list all invoices
        $invoices = Invoice::with(['subscriptionWebsite'])
            ->paginate($perPage, ['*'], 'page', $currentPage);

        // return response
        return response()->json([
            "success" => true,
            "message" => "Invoices retrieved successfully.",
            "data" => $invoices
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
