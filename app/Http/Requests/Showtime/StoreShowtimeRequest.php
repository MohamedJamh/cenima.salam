<?php

namespace App\Http\Requests\Showtime;

use Illuminate\Foundation\Http\FormRequest;

class StoreShowtimeRequest extends FormRequest
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
            'date' => ['required','date','after_or_equal:today'],
            'starts' => ['required','date_format:H:i:s'],
            'movie_id' => ['required','exists:movies,id'],
            'theater_id' => ['required','exists:theaters,id'],
        ];
    }
}
