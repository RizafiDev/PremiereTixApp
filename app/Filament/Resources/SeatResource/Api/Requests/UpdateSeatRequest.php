<?php

namespace App\Filament\Resources\SeatResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSeatRequest extends FormRequest
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
			'schedule_id' => 'required|integer',
			'seat_code' => 'required|string',
			'is_booked' => 'required|integer',
			'booked_by' => 'required|integer'
		];
    }
}
