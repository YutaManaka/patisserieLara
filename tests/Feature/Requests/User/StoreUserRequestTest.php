<?php

namespace Tests\Feature\Requests\User;

use App\Http\Requests\User\StoreUserRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Tests\ValidationTestCase;

class StoreUserRequestTest extends ValidationTestCase
{
    protected function request(): FormRequest
    {
        return new StoreUserRequest();
    }

    protected function baseInput(): array
    {
        return [
            'name'            => 'taro_yamada',
            'email'           => 'taro_yamada',
            'permission'      => 80,
            'change_password' => true,
            'new_password'    => 'aaaaaa',
        ];
    }

    public function formData()
    {
        return [
            'All OK' => [
                true,
            ],

            'nameが存在しない' => [
                false, [], 'name',
            ],

            'nameが25文字を超える' => [
                false, ['name' => Str::random(26)],
            ],

            'emailが存在しない' => [
                false, [], 'email',
            ],

            'emailが25文字を超える' => [
                false, ['email' => Str::random(26)],
            ],

            'permissionが存在しない' => [
                false, [], 'permission',
            ],

            'new_passwordが存在しない' => [
                false, [], 'new_password',
            ],

            'new_passwordが6文字以下' => [
                false, ['new_password' => Str::random(5)],
            ],
        ];
    }
}
