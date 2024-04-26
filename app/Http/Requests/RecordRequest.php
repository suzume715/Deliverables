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
            'kif' => 
                function ($attribute, $value, $fail) {
                    $extension = $value->getClientOriginalExtension();
                    if ($extension !== "kif") {
                        $fail('アップロード可能な拡張子は .kif です。');
                    }
                },'max:512'
        ];
    }
    
    public function attributes()
    {
        return [
            'record.title' => 'タイトル',
            'record.first_player_name' => '先手の名前',
            'record.second_player_name' => '後手の名前',
            'record.first_player_strategy' => '先手の戦法',
            'record.second_player_strategy' => '後手の戦法',
            'record.first_player_castle' => '先手の囲い',
            'record.second_player_castle' => '後手の囲い',
            'record.remark' => '備考',
            'kif' => 'kifファイル'
        ];
    }
}
