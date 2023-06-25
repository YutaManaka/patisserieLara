<?php

namespace Tests\Feature\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\User;
use Tests\TestCase;
use Tests\WithDb;

class OrderControllerTest extends TestCase
{
    use WithDb;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->post('/login', [
            'email'    => $this->user->email,
            'password' => 'password',
        ]);
    }

    public function testIndexOrder()
    {
        $item1  = Item::factory()->create();
        $item2  = Item::factory()->create();
        $order1 = Order::create([
            'item_id'         => $item1->id,
            'order_no'        => 1,
            'sequence'        => 1,
            'quantity'        => 1,
            'order_date'      => now()->format('Y-m-d'),
            'order_group_key' => 'aaa',
        ]);
        $order2 = Order::create([
            'item_id'         => $item2->id,
            'order_no'        => 1,
            'sequence'        => 2,
            'quantity'        => 2,
            'order_date'      => now()->format('Y-m-d'),
            'order_group_key' => 'aaa',
        ]);

        $response = $this->get(route('order'));
        $response->assertStatus(200);
        $response->assertSeeInOrder([
            $order2->order_no,
            $order2->sequence,
            $item2->name,
            $order2->quantity,
            $order1->order_no,
            $order1->sequence,
            $item1->name,
            $order1->quantity,
        ]);
    }

    public function testSetOrdersDelivered()
    {
        $item3  = Item::factory()->create();
        $item4  = Item::factory()->create();
        $item5  = Item::factory()->create();
        $order3 = Order::create([
            'item_id'         => $item3->id,
            'order_no'        => 2,
            'sequence'        => 1,
            'quantity'        => 1,
            'order_date'      => now()->format('Y-m-d'),
            'order_group_key' => 'bbb',
        ]);
        $order4 = Order::create([
            'item_id'         => $item4->id,
            'order_no'        => 2,
            'sequence'        => 2,
            'quantity'        => 1,
            'order_date'      => now()->format('Y-m-d'),
            'order_group_key' => 'bbb',
        ]);
        $order5 = Order::create([
            'item_id'         => $item5->id,
            'order_no'        => 3,
            'sequence'        => 1,
            'quantity'        => 1,
            'order_date'      => now()->format('Y-m-d'),
            'order_group_key' => 'ccc',
        ]);
        $response = $this->put(route('order.set-orders-delivered', $order3->id));
        $response->assertStatus(302);
        $response->assertRedirect('orders');

        $this->assertNotNull(Order::find($order3->id)->delivered_at);
        $this->assertNotNull(Order::find($order4->id)->delivered_at);
        $this->assertNull(Order::find($order5->id)->delivered_at);
    }
}
