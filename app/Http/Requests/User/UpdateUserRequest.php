<?php

namespace App\Http\Requests\User;

class UpdateUserRequest extends StoreUserRequest
{
    public function rules()
    {
        $rules = parent::rules();

        $rules['new_password'] = ['required_if:change_password,true', 'min:6'];

        return $rules;
    }
}
