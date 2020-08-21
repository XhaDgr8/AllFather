<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubProductStoreRequest extends FormRequest
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
            'created_by' => 'required|integer|exists:users,id',
            'updated_by' => 'nullable|integer|exists:users,id',
            'cat_number' => 'nullable|string|max:400',
            'name' => 'required|string|max:400',
            'description' => 'nullable|string',
            'country_of_origin' => 'nullable|string|max:400',
            'facility_name' => 'nullable|string|max:400',
            'buying_unit' => 'nullable|string|max:400',
            'price_per_unit' => 'nullable|string|max:400',
            'production_unit' => 'nullable|string|max:400',
            'production_price' => 'nullable|string|max:400',
            'quantity' => 'nullable|string|max:400',
            'price_for_customer' => 'nullable|string|max:400',
            'price_for_admin' => 'nullable|string|max:400',
            'other_costs' => 'nullable|string|max:400',
            'image' => 'nullable|string|max:400',
            'image_alt' => 'nullable|string|max:400',
            'category' => 'nullable|string|max:400',
            'key_words' => 'nullable|string|max:400',
        ];
    }
}
