<?php

namespace Tests\Feature\Requests\Item;

use App\Http\Requests\Item\StoreItemRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Tests\ValidationTestCase;

class StoreItemRequestTest extends ValidationTestCase
{
    protected function request(): FormRequest
    {
        return new StoreItemRequest();
    }

    protected function baseInput(): array
    {
        return [
            'code'               => 1,
            'name'               => 'テスト',
            'receipt_name'       => 'テスト',
            'description'        => 'テスト',
            'price'              => 108,
            'tax'                => 8,
            'tax_excluded_price' => 100,
            'sort_order'         => 1,
        ];
    }

    public function formData()
    {
        return [
            'All OK' => [
                true,
            ],

            'codeが存在しない' => [
                false, [], 'code',
            ],

            'codeが指定した形式ではない' => [
                false, ['code' => '１'],
            ],

            'codeが299999以上' => [
                false, ['code' => 300000],
            ],

            'nameが存在しない' => [
                false, [], 'name',
            ],

            'nameが20文字を超える' => [
                false, ['name' => Str::random(21)],
            ],

            'receipt_nameが存在しない' => [
                false, [], 'receipt_name',
            ],

            'receipt_nameが10文字を超える' => [
                false, ['receipt_name' => Str::random(11)],
            ],

            'descriptionが存在しない' => [
                true, [], 'description',
            ],

            'descriptionが50文字を超える' => [
                false, ['description' => Str::random(51)],
            ],

            'priceが存在しない' => [
                false, [], 'price',
            ],

            'priceが指定した形式ではない' => [
                false, ['price' => '１'],
            ],

            'priceが99999以上' => [
                false, ['price' => 100000],
            ],

            'taxが存在しない' => [
                false, [], 'tax',
            ],

            'taxが指定した形式ではない' => [
                false, ['tax' => '１'],
            ],

            'taxが99999以上' => [
                false, ['tax' => 100000],
            ],

            'tax_excluded_priceが存在しない' => [
                false, [], 'tax_excluded_price',
            ],

            'tax_excluded_priceが指定した形式ではない' => [
                false, ['tax_excluded_price' => '１'],
            ],

            'tax_excluded_priceが99999以上' => [
                false, ['tax_excluded_price' => 300000],
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
