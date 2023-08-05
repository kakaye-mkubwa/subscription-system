<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'invoice_id' => 'required|integer|exists:invoices,id',
            'amount' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/', // regex for decimal with 2 places
            'description' => 'required|string',
            'date_paid' => 'required|date',
            'paid_by' => 'required|string',
        ];
    }
}
