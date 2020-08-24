<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'created_by' => 'nullable|integer|exists:users,id',
            'updated_by' => 'required|integer|exists:users,id',
            'cat_number' => 'nullable|string',
            'name' => 'nullable|string|max:400',
            'description' => 'nullable|string',
            'stock_quantity' => 'nullable|integer',
            'price_for_customer' => 'nullable|integer',
            'price_for_admin' => 'nullable|integer',
            'other_costs' => 'nullable|integer',
            'image' => 'nullable|string',
            'image_alt' => 'nullable|string',
            'category' => 'nullable|string|max:400',
            'key_words' => 'nullable|string|max:400',
        ];
    }
}
