<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'name'                => 'ユーザ名',
            'email'               => 'ログインID',
            'permission'          => '権限',
            'top_page_transition' => 'トップ画面の遷移先を変更',
            'change_password'     => 'パスワードを変更する',
            'new_password'        => 'パスワード',
        ];
    }

    public function rules()
    {
        return [
            'name'  => ['required', 'max: 25'],
            'email' => [
                'required',
                'max: 25',
                Rule::unique(User::class)->ignore($this->id ?? $this->user->id ?? null),
            ],
            'permission'          => ['nullable'],
            'top_page_transition' => ['nullable'],
            'change_password'     => ['nullable'],
            'new_password'        => ['required', 'min:6'],
        ];
    }
}
