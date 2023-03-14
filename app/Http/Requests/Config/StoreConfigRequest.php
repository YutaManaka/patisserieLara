<?php

namespace App\Http\Requests\Config;

use App\Models\Config;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreConfigRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'key'   => 'キー',
            'value' => '値',
        ];
    }

    public function rules()
    {
        return [
            'key' => [
                'required',
                'max:64',
                Rule::unique(Config::class)->ignore($this->key, 'key'),
            ],
            'value'       => ['required'],
            'description' => ['required', 'max:64'],
        ];
    }
}
