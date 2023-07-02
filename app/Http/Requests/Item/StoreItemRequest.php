<?php

namespace App\Http\Requests\Item;

use App\Consts\Common;
use App\Models\Item;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreItemRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'code'               => Common::COMMON_LABELS['code'],
            'image'              => Common::COMMON_LABELS['img_url'],
            'name'               => Common::COMMON_LABELS['name'],
            'receipt_name'       => Common::COMMON_LABELS['receipt_name'],
            'description'        => Item::ITEM_LABELS['description'],
            'price'              => Common::COMMON_LABELS['price'],
            'tax'                => Common::COMMON_LABELS['tax'],
            'tax_excluded_price' => Common::COMMON_LABELS['tax_excluded_price'],
            'sort_order'         => Common::COMMON_LABELS['sort_order'],
            'disabled'           => Item::ITEM_LABELS['disabled'],
        ];
    }

    public function rules()
    {
        return [
            'code' => [
                'required',
                'int',
                'max:29999',
                Rule::unique(Item::class)->ignore($this->item->id ?? null),
            ],
            'image'              => ['nullable', 'mimes:jpeg,jpg,png'],
            'name'               => ['required', 'max:20'],
            'receipt_name'       => ['required', 'max:10'],
            'description'        => ['nullable', 'max:50'],
            'price'              => ['required', 'int', 'max:99999'],
            'tax'                => ['required', 'int', 'max:99999'],
            'tax_excluded_price' => ['required', 'int', 'max:99999'],
            'sort_order'         => ['required', 'numeric', 'between:-100,100'],
            'disabled'           => ['nullable'],
        ];
    }
}
