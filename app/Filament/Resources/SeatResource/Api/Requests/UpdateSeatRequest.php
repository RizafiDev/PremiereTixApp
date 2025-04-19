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
    public function rules()
    {
        return [
            'schedule_id' => 'required|exists:schedules,id',
            'seat_code' => 'required|string', // Validasi seat_code
            'is_booked' => 'required|boolean',
        ];
    }
}
