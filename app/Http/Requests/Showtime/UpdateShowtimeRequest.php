<?php

namespace App\Http\Requests\Showtime;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShowtimeRequest extends FormRequest
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
            'date' => ['sometimes','required','date','after_or_equal:today'],
            'starts' => ['sometimes','required','date_format:H:i'],
            'theater_id' => ['sometimes','required','exists:theaters,id'],
        ];
    }
}
