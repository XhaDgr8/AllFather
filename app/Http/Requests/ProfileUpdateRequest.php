<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_name' => 'nullable|string|unique:profiles|max:400',
            'status' => 'nullable|string|max:400',
            'avatar' => 'nullable|string',
            'address' => 'nullable|string',
            'company_number' => 'nullable|string',
            'tel' => 'nullable|string',
            'vat_no' => 'nullable|string',
//            'user_id' => 'required|integer|exists:users,id',
        ];
    }
}
