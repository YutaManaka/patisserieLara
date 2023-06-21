<?php

namespace App\Actions\Receipt;

use App\Models\Order;
use App\Models\Receipt;

class StoreReceipt
{
    public function execute(array $orderIds): Receipt
    {
        $totalPrice            = 0; // 合計金額(税込)
        $totalTax              = 0; // 合計税額
        $totalTaxExcludedPrice = 0; // 合計金額(税抜)

        $orders = Order::whereIn('id', $orderIds)->with('item')->get();

        foreach ($orders as $order) {
            $totalPrice            += $order->item->price;
            $totalTax              += $order->item->tax;
            $totalTaxExcludedPrice += $order->item->tax_excluded_price;
        }

        // receiptレコード作成
        $receipt = Receipt::create([
            'total_price'              => $totalPrice,
            'total_tax'                => $totalTax,
            'total_tax_excluded_price' => $totalTaxExcludedPrice,
        ]);

        // ordersとreceiptのリレーション作成
        foreach ($orderIds as $orderId) {
            $orderRecord = Order::find($orderId);
            $orderRecord->update(['receipt_id' => $receipt->id]);
        }

        return $receipt;
    }
}
