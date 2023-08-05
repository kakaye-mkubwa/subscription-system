<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'user_subscription_id' => 'required|integer|exists:user_subscriptions,id',
            'issue_date' => 'required|date',
            'due_date' => 'required|date|after:issue_date',
            'amount' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/', // regex for decimal with 2 places
            'payment_status' => 'required|string|in:paid,unpaid',
        ];
    }
}
