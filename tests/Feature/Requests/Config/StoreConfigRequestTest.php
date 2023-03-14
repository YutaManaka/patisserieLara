<?php

namespace Tests\Feature\Requests\Config;

use App\Http\Requests\Config\StoreConfigRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Tests\ValidationTestCase;

class StoreConfigRequestTest extends ValidationTestCase
{
    protected function request(): FormRequest
    {
        return new StoreConfigRequest();
    }

    protected function baseInput(): array
    {
        return [
            'key'         => 'hoge',
            'type'        => 'string',
            'value'       => 'hogehoge',
            'description' => 'hogehogehoge',
        ];
    }

    public function formData()
    {
        return [
            'All OK' => [
                true,
            ],

            'keyが存在しない' => [
                false, [], 'key',
            ],

            'keyが64文字を超える' => [
                false, ['key' => Str::random(65)],
            ],

            'typeが存在しない' => [
                false, [], 'type',
            ],

            'valueが存在しない' => [
                false, [], 'value',
            ],

            'descriptionが存在しない' => [
                false, [], 'description',
            ],

            'descriptionが64文字以上' => [
                false, ['description' => Str::random(65)],
            ],
        ];
    }
}
