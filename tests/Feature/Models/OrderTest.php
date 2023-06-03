<?php

namespace Tests\Feature\Models;

use App\Models\Order;
use Tests\TestCase;
use Tests\WithDb;

class OrderTest extends TestCase
{
    use WithDb;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testFillable()
    {
        $attributes = [
            'order_no'        => 1,
            'sequence'        => 1,
            'quantity'        => 1,
            'order_date'      => '2023-01-01',
            'order_group_key' => 'aaa',
        ];
        $order = Order::create($attributes);
        $order->refresh();

        collect($attributes)
            ->each(fn ($val, $key) => $this->assertSame($val, $order->$key));
    }

    public function testCreate()
    {
        $attributes = [
            'order_no'        => 2,
            'sequence'        => 2,
            'quantity'        => 2,
            'order_date'      => '2023-01-01',
            'order_group_key' => 'bbb',
            'delivered_at'    => now(),
        ];
        Order::create($attributes);
        $orders = Order::get();
        $this->assertSame(1, $orders->count());
    }

    public function testDelete()
    {
        $attributes = [
            'order_no'        => 3,
            'sequence'        => 3,
            'quantity'        => 3,
            'order_date'      => '2023-01-01',
            'order_group_key' => 'ccc',
            'delivered_at'    => now(),
        ];
        $order = Order::create($attributes);

        $order->delete();
        $order->refresh();

        $this->assertSoftDeleted($order);
    }
}
