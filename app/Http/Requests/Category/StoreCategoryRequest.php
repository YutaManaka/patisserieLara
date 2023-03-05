<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'name'             => '表示名称',
            'order_start_time' => '提供開始時間',
            'order_end_time'   => '提供終了時間',
            'sort_order'       => '表示順',
            'image'            => '表示写真',
        ];
    }

    public function rules()
    {
        return [
            'name'             => ['required', 'max:15'],
            'order_start_time' => ['required', 'regex:/^([01][0-9]|2[0-3]):[0-5][0-9]$/', 'before:order_end_time'],
            'order_end_time'   => ['required', 'regex:/^([01][0-9]|2[0-3]):[0-5][0-9]$/', 'after:order_start_time'],
            'sort_order'       => ['required', 'numeric', 'between:-100,100'],
            'image'            => ['nullable', 'mimes:jpeg,jpg,png'],
        ];
    }

    public function messages()
    {
        return [
            'before' => ':attributeには:date以前の時間を指定してください。',
            'after'  => ':attributeには:date以降の時間を指定してください。',
        ];
    }
}
