<?php

namespace App\Filament\Resources\TicketTransactionResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketTransactionRequest extends FormRequest
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
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            return [
                'status' => 'required|string',
            ];
        }
    
        // Default (misalnya untuk POST)
        return [
            'order_id' => 'required|string',
            'appuser_id' => 'required|integer',
            'schedule_id' => 'required|integer',
            'seats' => 'required',
            'gross_amount' => 'required|integer',
            'status' => 'required',
            'snap_token' => 'nullable|string'
        ];
    }
    
}
