<?php

namespace App\Actions\Order;

use App\Actions\Receipt\StoreReceipt;
use App\Models\Item;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateDemoOrdersAndReceipts
{
    public function execute()
    {
        // 既存の売上データを削除
        DB::table('orders')->truncate();

        // 売上データ作成
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
            $response = app(StoreOrder::class)->execute(['items' => $items]);

            // レシート作成
            app(StoreReceipt::class)->execute($response['order_ids']);

            // 時間を進める
            Carbon::setTestNow(now('Asia/Tokyo')->addMinutes(10));
        }
    }
}
