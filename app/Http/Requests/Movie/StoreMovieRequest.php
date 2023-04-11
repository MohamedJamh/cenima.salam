<?php

namespace App\Http\Requests\Movie;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMovieRequest extends FormRequest
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
            'title' => ['required','string','unique:movies,title'],
            'tagline' => ['required','string'],
            'budget' => ['sometimes','required','numeric','decimal:0,2'],
            'language' => ['required','string'],
            'overview' => ['required','string'],
            'release_date' => ['required','date'],
            'runtime' => ['required','integer'],
            'rate' => ['required','numeric','decimal:1'],
            'status' => ['required',Rule::in(['popular', 'premier','upcoming'])],
            'genres' => ['required'],
            'production_companies' => ['required','array'],
            'images' => ['required']
        ];
    }
}
