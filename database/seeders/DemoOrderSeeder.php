<?php

namespace Database\Seeders;

use App\Actions\Order\StoreOrder;
use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class DemoOrderSeeder extends Seeder
{
    /**
     * 検証用注文データを作成。
     *
     * @return void
     */
    public function run()
    {
        $orderNumber = rand(25, 50);
        Carbon::setTestNow(Carbon::createFromTime(10, 0, 0));

        for ($i = 0; $i <= $orderNumber; ++$i) {
            $itemNumber    = rand(1, 3);
            $orderGroupKey = Str::uuid();
            $items         = [];
            for ($j = 0; $j <= $itemNumber; ++$j) {
                // 商品を選択
                $item = Item::query()
                    ->has('categories')
                    ->inRandomOrder('id')
                    ->get()
                    ->random(1)
                    ->first();
                // カートに追加
                $items[] = [
                    'item_id'         => $item->id,
                    'quantity'        => rand(1, 3),
                    'order_group_key' => $orderGroupKey,
                ];
            }
            // 注文API実行
            app(StoreOrder::class)->execute(['items' => $items]);

            // 時間を進める
            Carbon::setTestNow(now('Asia/Tokyo')->addMinutes(10));
        }
    }
}
