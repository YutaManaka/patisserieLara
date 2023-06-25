<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Seeder;

class DemoConfigSeeder extends Seeder
{
    /**
     * システム設定のデータを作成する。
     *
     * @return void
     */
    public function run()
    {
        $configs = [
            [
                'key'         => 'shop_name',
                'type'        => 'string',
                'value'       => '"Pâtisserie Lara"',
                'description' => '店舗名',
            ],
            [
                'key'         => 'tel',
                'type'        => 'string',
                'value'       => '"0120-123-456"',
                'description' => '電話番号',
            ],
            [
                'key'         => 'fax',
                'type'        => 'string',
                'value'       => '"0120-123-789"',
                'description' => 'Fax番号',
            ],
            [
                'key'         => 'receipt_description',
                'type'        => 'string',
                'value'       => '"ご利用ありがとうございます！"',
                'description' => 'レシート文言',
            ],
        ];

        Config::upsert(
            $configs, // 第一引数：データを格納した配列
            ['key'], // 第二引数：どのカラムをユニークにするか
            ['type', 'value', 'description'], // 第三引数：どのカラムを更新するか
        );
    }
}
