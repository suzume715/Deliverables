<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    //public function authorize()
    //{
    //    return false;
    //}

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'record.title' => 'required|string|max:50',
            'record.first_player_name' => 'nullable|string|max:20',
            'record.second_player_name' => 'nullable|string|max:20',
            'record.first_player_strategy' => 'nullable|string|max:20',
            'record.second_player_strategy' => 'nullable|string|max:20',
            'record.first_player_castle' => 'nullable|string|max:20',
            'record.second_player_castle' => 'nullable|string|max:20',
            'record.remark' => 'nullable|string|max:200',
            'record.record' => 'string',
            'kif' => 'required|mimes:txt|max:512'
        ];
    }
}
