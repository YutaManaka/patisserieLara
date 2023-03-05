<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class DemoCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name'       => 'プチガトー',
                'sort_order' => 0,
            ],
            [
                'name'       => 'グランガトー',
                'sort_order' => 1,
            ],
            [
                'name'       => 'パン',
                'sort_order' => 2,
            ],
            [
                'name'       => '焼き菓子',
                'sort_order' => 3,
            ],
            [
                'name'       => 'マカロン',
                'sort_order' => 4,
            ],
            [
                'name'       => 'ショコラ',
                'sort_order' => 5,
            ],
            [
                'name'       => '詰合せギフト',
                'sort_order' => 6,
            ],
        ];

        Category::upsert(
            $categories, // 第一引数：データを格納した配列
            ['name'], // 第二引数：どのカラムをユニークにするか
            ['sort_order'], // 第三引数：どのカラムを更新するか
        );
    }
}
