<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
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
            'address_line_1' => 'required',
            'address_line_2',
            'city' => 'required',
            'postcode' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'address_line_1.required' => 'Address line 1 is required',
            'address_line_2.required' => 'Address line 2 is required',
            'city.required' => 'City is required',
            'postcode.required' => 'Postcode is required',
        ];
    }
}