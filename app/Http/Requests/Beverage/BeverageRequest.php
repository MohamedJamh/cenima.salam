<?php

namespace App\Http\Requests\Beverage;

use Illuminate\Foundation\Http\FormRequest;

class BeverageRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required','string'],
            'description' => ['required','string'],
            'price' => ['required','numeric','decimal:0,2'],
            'beverage_type_id' => ['required','integer']
        ];
    }
}
