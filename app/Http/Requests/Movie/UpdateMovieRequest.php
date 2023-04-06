<?php

namespace App\Http\Requests\Movie;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMovieRequest extends FormRequest
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
            'title' => ['sometimes','required','string','unique:movies,title'],
            'tagline' => ['sometimes','required','string'],
            'budget' => ['sometimes','required','numeric','decimal:0,2'],
            'language' => ['sometimes','required','string'],
            'overview' => ['sometimes','required','string'],
            'release_date' => ['sometimes','required','date'],
            'runtime' => ['sometimes','required','integer'],
            'rate' => ['sometimes','required','numeric','decimal:1'],
            'status' => ['sometimes','required',Rule::in(['popular', 'premier','upcoming'])],
            'genres' => ['sometimes','required'],
            'production_companies' => ['sometimes','required'],
            'backdrop_img' => ['sometimes','required'] ,
            'poster_img' => ['sometimes','required']
        ];
    }
}
