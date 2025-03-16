<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookingRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'start_date' => [
                'required',
                'date',
                'after:today',
            ],
            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
            ],
            'payment_method' => [
                'required',
                Rule::in(['credit_card', 'paypal', 'bank_transfer']),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'start_date.after' => 'The start date must be from tomorrow onward.',
            'end_date.after_or_equal' => 'The end date must be the same or after the start date.',
            'payment_method.in' => 'Invalid payment method selected.',
        ];
    }
}
