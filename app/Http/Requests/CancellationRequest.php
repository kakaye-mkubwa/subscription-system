<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CancellationRequest extends FormRequest
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
            'user_id' => 'required|integer|exists:users,id',
            'subscription_website_id' => 'required|integer|exists:subscription_websites,id',
            'request_date' => 'required|date',
            'approval_date' => 'nullable|date',
            'reason' => 'required|string',
            'approval_status' => 'required|string|in:approved,declined,pending',
        ];
    }
}
