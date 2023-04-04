<?php

namespace App\Http\Requests\Theater;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTheaterRequest extends FormRequest
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
            'name' => ['sometimes','required','string'],
            'schema_id' => ['sometimes','required','exists:schemas,id']
        ];
    }
}
