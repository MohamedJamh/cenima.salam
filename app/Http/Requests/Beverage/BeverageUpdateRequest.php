<?php

namespace App\Http\Requests\Beverage;

use Illuminate\Foundation\Http\FormRequest;

class BeverageUpdateRequest extends FormRequest
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
            'title' => ['sometimes','required','string'],
            'description' => ['sometimes','required','string'],
            'price' => ['sometimes','required','numeric','decimal:0,2'],
            'beverage_type_id' => ['sometimes','required','integer'],
            'image' => ['sometimes']
        ];
    }
}
