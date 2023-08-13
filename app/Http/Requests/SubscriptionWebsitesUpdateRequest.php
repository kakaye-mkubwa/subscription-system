<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionWebsitesUpdateRequest extends FormRequest
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
            'website_name' => 'required|string|unique:subscription_websites,website_name,' . $this->id . ',id',
            'website_url' => 'required|string|unique:subscription_websites,website_url,' . $this->id . ',id',
            'description' => 'required|string',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/', // 2 decimal places
            'duration_in_months' => 'required|int|min:1',
        ];
    }
}
