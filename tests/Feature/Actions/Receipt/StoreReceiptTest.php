<?php

namespace Tests\Feature\Actions\Receipt;

use App\Actions\Receipt\StoreReceipt;
use App\Models\Item;
use App\Models\Order;
use Tests\TestCase;
use Tests\WithDb;

class StoreReceiptTest extends TestCase
{
    use WithDb;

    protected $action;
    protected $item1;
    protected $item2;

    public function setUp(): void
    {
        parent::setUp();

        $this->action = app(StoreReceipt::class);

        $this->item1 = Item::factory()->create([
            'price'              => 650,
            'tax'                => 48,
            'tax_excluded_price' => 602,
        ]);
        $this->item2 = Item::factory()->create([
            'price'              => 550,
            'tax'                => 40,
            'tax_excluded_price' => 510,
        ]);
    }

    // 1品、1個注文の合計金額
    public function testStoreReceiptWithOneOrderOneQuantity()
    {
        $order1 = Order::create([
            'item_id'         => $this->item1->id,
            'receipt_id'      => null,
            'order_no'        => 1,
            'sequence'        => 1,
            'quantity'        => 1,
            'order_date'      => now()->format('Y-m-d'),
            'order_group_key' => 'AAA',
            'delivered_at'    => null,
        ]);
        $receipt1 = $this->action->execute([$order1->id]);

        // 合計金額(税込)、合計税額、合計金額(税抜)の確認
        $this->assertSame($receipt1->total_price, $this->item1->price * 1);
        $this->assertSame($receipt1->total_tax, $this->item1->tax * 1);
        $this->assertSame($receipt1->total_tax_excluded_price, $this->item1->tax_excluded_price * 1);
    }

    // 1品、複数個注文の合計金額
    public function testStoreReceiptWithOneOrderMultipleQuantity()
    {
        $order1 = Order::create([
            'item_id'         => $this->item1->id,
            'receipt_id'      => null,
            'order_no'        => 1,
            'sequence'        => 1,
            'quantity'        => 2,
            'order_date'      => now()->format('Y-m-d'),
            'order_group_key' => 'AAA',
            'delivered_at'    => null,
        ]);
        $receipt1 = $this->action->execute([$order1->id]);

        // 合計金額(税込)、合計税額、合計金額(税抜)の確認
        $this->assertSame($receipt1->total_price, $this->item1->price * 2);
        $this->assertSame($receipt1->total_tax, $this->item1->tax * 2);
        $this->assertSame($receipt1->total_tax_excluded_price, $this->item1->tax_excluded_price * 2);
    }

    // 複数品、1個注文の合計金額
    public function testStoreReceiptWithMultipleOrderOneQuantity()
    {
        $order1 = Order::create([
            'item_id'         => $this->item1->id,
            'receipt_id'      => null,
            'order_no'        => 1,
            'sequence'        => 1,
            'quantity'        => 1,
            'order_date'      => now()->format('Y-m-d'),
            'order_group_key' => 'AAA',
            'delivered_at'    => null,
        ]);
        $order2 = Order::create([
            'item_id'         => $this->item2->id,
            'receipt_id'      => null,
            'order_no'        => 1,
            'sequence'        => 2,
            'quantity'        => 1,
            'order_date'      => now()->format('Y-m-d'),
            'order_group_key' => 'AAA',
            'delivered_at'    => null,
        ]);
        $receipt1 = $this->action->execute([$order1->id, $order2->id]);

        // 合計金額(税込)、合計税額、合計金額(税抜)の確認
        $this->assertSame($receipt1->total_price, ($this->item1->price * 1) + ($this->item2->price * 1));
        $this->assertSame($receipt1->total_tax, ($this->item1->tax * 1) + ($this->item2->tax * 1));
        $this->assertSame($receipt1->total_tax_excluded_price, ($this->item1->tax_excluded_price * 1) + ($this->item2->tax_excluded_price * 1));
    }

    // 複数品、複数個注文の合計金額
    public function testStoreReceiptWithMultipleOrderMultipleQuantity()
    {
        $order1 = Order::create([
            'item_id'         => $this->item1->id,
            'receipt_id'      => null,
            'order_no'        => 1,
            'sequence'        => 1,
            'quantity'        => 2,
            'order_date'      => now()->format('Y-m-d'),
            'order_group_key' => 'AAA',
            'delivered_at'    => null,
        ]);
        $order2 = Order::create([
            'item_id'         => $this->item2->id,
            'receipt_id'      => null,
            'order_no'        => 1,
            'sequence'        => 2,
            'quantity'        => 2,
            'order_date'      => now()->format('Y-m-d'),
            'order_group_key' => 'AAA',
            'delivered_at'    => null,
        ]);
        $receipt1 = $this->action->execute([$order1->id, $order2->id]);

        // 合計金額(税込)、合計税額、合計金額(税抜)の確認
        $this->assertSame($receipt1->total_price, ($this->item1->price * 2) + ($this->item2->price * 2));
        $this->assertSame($receipt1->total_tax, ($this->item1->tax * 2) + ($this->item2->tax * 2));
        $this->assertSame($receipt1->total_tax_excluded_price, ($this->item1->tax_excluded_price * 2) + ($this->item2->tax_excluded_price * 2));
    }
}
