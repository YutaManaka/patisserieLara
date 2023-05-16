<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Database\Seeder;

class DemoItemSeeder extends Seeder
{
    private $unCategorizedItems = [
        [
            'code'               => 1,
            'name'               => '新作ケーキA',
            'receipt_name'       => '新作ケーキA',
            'description'        => 'これは新作ケーキAです。',
            'price'              => 650,
            'tax'                => 48,
            'tax_excluded_price' => 602,
            'sort_order'         => 0,
        ],
        [
            'code'               => 2,
            'name'               => '新作ケーキB',
            'receipt_name'       => '新作ケーキB',
            'description'        => 'これは新作ケーキBです。',
            'price'              => 550,
            'tax'                => 40,
            'tax_excluded_price' => 510,
            'sort_order'         => 0,
        ],
    ];

    private $petitGateau = [
        [
            'code'               => 100,
            'name'               => 'オペラ',
            'receipt_name'       => 'オペラ',
            'description'        => 'これはオペラです。',
            'price'              => 650,
            'tax'                => 48,
            'tax_excluded_price' => 602,
            'sort_order'         => 0,
        ],
        [
            'code'               => 101,
            'name'               => 'チョコレートケーキ',
            'receipt_name'       => 'チョコレートケーキ',
            'description'        => 'これはチョコレートケーキです。',
            'price'              => 550,
            'tax'                => 40,
            'tax_excluded_price' => 510,
            'sort_order'         => 0,
        ],
    ];
    private $grandGateau = [];
    private $bread       = [];
    private $pastry      = [];
    private $macarons    = [];
    private $chocolate   = [];
    private $gift        = [];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 未分類商品
        foreach ($this->unCategorizedItems as $data) {
            $item = Item::factory($data)->create();
        }

        $category = Category::factory()->create(['name' => 'プチガトー', 'sort_order' => 0]);
        foreach ($this->petitGateau as $data) {
            $item = Item::factory($data)->create();
            $category->items()->save($item);
        }

        $category = Category::factory()->create(['name' => 'グランガトー', 'sort_order' => 1]);
        foreach ($this->grandGateau as $data) {
            $item = Item::factory($data)->create();
            $category->items()->save($item);
        }

        $category = Category::factory()->create(['name' => 'パン', 'sort_order' => 2]);
        foreach ($this->bread as $data) {
            $item = Item::factory($data)->create();
            $category->items()->save($item);
        }

        $category = Category::factory()->create(['name' => '焼き菓子', 'sort_order' => 3]);
        foreach ($this->pastry as $data) {
            $item = Item::factory($data)->create();
            $category->items()->save($item);
        }

        $category = Category::factory()->create(['name' => 'マカロン', 'sort_order' => 4]);
        foreach ($this->macarons as $data) {
            $item = Item::factory($data)->create();
            $category->items()->save($item);
        }

        $category = Category::factory()->create(['name' => 'ショコラ', 'sort_order' => 5]);
        foreach ($this->chocolate as $data) {
            $item = Item::factory($data)->create();
            $category->items()->save($item);
        }

        $category = Category::factory()->create(['name' => '詰合せギフト', 'sort_order' => 6]);
        foreach ($this->gift as $data) {
            $item = Item::factory($data)->create();
            $category->items()->save($item);
        }
    }
}
