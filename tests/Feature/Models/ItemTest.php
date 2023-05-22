<?php

namespace Tests\Feature\Models;

use App\Models\Item;
use Tests\TestCase;
use Tests\WithDb;

class ItemTest extends TestCase
{
    use WithDb;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testFillable()
    {
        $attributes = [
            'code'               => 1,
            'img_url'            => 'https://example.png',
            'name'               => 'テスト',
            'receipt_name'       => 'テスト',
            'description'        => 'テスト',
            'price'              => 108,
            'tax'                => 8,
            'tax_excluded_price' => 100,
            'sort_order'         => 1,
            'disabled'           => 0,
        ];
        $item = Item::create($attributes);
        $item->refresh();

        collect($attributes)
            ->each(fn ($val, $key) => $this->assertSame($val, $item->$key));
    }

    public function testCreate()
    {
        $attributes = [
            'code'               => 1,
            'img_url'            => 'https://example.png',
            'name'               => 'テスト',
            'receipt_name'       => 'テスト',
            'description'        => 'テスト',
            'price'              => 108,
            'tax'                => 8,
            'tax_excluded_price' => 100,
            'sort_order'         => 1,
            'disabled'           => 0,
        ];
        Item::create($attributes);
        $items = Item::get();
        $this->assertSame(1, $items->count());
    }

    public function testDelete()
    {
        $attributes = [
            'code'               => 1,
            'img_url'            => 'https://example.png',
            'name'               => 'テスト',
            'receipt_name'       => 'テスト',
            'description'        => 'テスト',
            'price'              => 108,
            'tax'                => 8,
            'tax_excluded_price' => 100,
            'sort_order'         => 1,
            'disabled'           => 0,
        ];
        $item = Item::create($attributes);

        $item->delete();
        $item->refresh();

        $this->assertSoftDeleted($item);
    }
}
