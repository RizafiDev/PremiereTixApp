<?php

namespace App\Filament\Resources\CouponResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCouponRequest extends FormRequest
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
			'code' => 'required|string',
			'discount' => 'required|integer',
			'is_active' => 'required|integer',
			'expired_at' => 'required|date'
		];
    }
}
