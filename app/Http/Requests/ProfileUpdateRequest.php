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
            'user_name' => 'string|max:400',
            'status' => 'nullable|string|max:400',
            'website' => 'url',
            'mobile' => 'string',
            'avatar' => 'string',
            'address' => 'string',
            'company_number' => 'string',
            'tel' => 'string',
            'vat_no' => 'string',
//            'user_id' => 'required|integer|exists:users,id',
        ];
    }
}
