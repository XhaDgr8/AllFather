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
            'first_name' => 'string|max:400',
            'last_name' => 'string|max:400',
            'status' => 'string|max:400',
            'website' => 'string',
            'mobile' => 'integer',
            'avatar' => 'string',
//            'user_id' => 'required|integer|exists:users,id',
        ];
    }
}
