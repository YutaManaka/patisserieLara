<?php

namespace Tests\Feature\Requests\TableOrder\Category;

use App\Http\Requests\Category\UpdateCategoryRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Tests\ValidationTestCase;

class UpdateCategoryRequestTest extends ValidationTestCase
{
    protected function request(): FormRequest
    {
        return new UpdateCategoryRequest();
    }

    protected function baseInput(): array
    {
        return [
            'name'             => 'カテゴリ名',
            'order_start_time' => '00:00',
            'order_end_time'   => '23:59',
            'sort_order'       => 1,
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

            'nameが15文字を超える' => [
                false, ['name' => Str::random(16)],
            ],

            'order_start_timeが存在しない' => [
                false, [], 'order_start_time',
            ],

            'order_start_timeが指定した形式ではない' => [
                false, ['order_start_time' => '99:99'],
            ],

            'order_start_timeがorder_end_time以降の時間を指定している' => [
                false, ['order_start_time' => '1:00', 'order_end_time' => '0:30'],
            ],

            'order_end_timeが存在しない' => [
                false, [], 'order_end_time',
            ],

            'order_end_timeが指定した形式ではない' => [
                false, ['order_end_time' => '99:99'],
            ],

            'order_end_timeがorder_start_time以前の時間を指定している' => [
                false, ['order_start_time' => '1:00', 'order_end_time' => '0:30'],
            ],

            'sort_orderが存在しない' => [
                false, [], 'sort_order',
            ],

            'sort_orderが指定した形式ではない' => [
                false, ['sort_order' => '３'],
            ],

            'sort_orderが-100~100の間の数値ではない' => [
                false, ['sort_order' => 101],
            ],

            'imageの拡張子がjpeg,jpg,pngではない' => [
                false, ['image' => 'http://via.placeholder.com/300.gif'],
            ],
        ];
    }
}
