<?php

namespace Tests\Feature\Controllers;

use App\Models\Item;
use App\Models\User;
use Tests\TestCase;
use Tests\WithDb;

class ItemControllerTest extends TestCase
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

    public function testIndexItem()
    {
        $item  = Item::factory()->create();
        $item2 = Item::factory()->create();

        $response = $this->get(route('item'));
        $response->assertStatus(200);
        $response->assertSeeInOrder([
            $item->code,
            $item->name,
            $item->sort_order,
            $item2->code,
            $item2->name,
            $item2->sort_order,
        ]);
    }

    public function testCreateItem()
    {
        $response = $this->get(route('item.create'));
        $response->assertStatus(200);
    }

    public function testStoreItem()
    {
        $data = [
            'code'               => 100,
            'name'               => 'storeTestName3',
            'receipt_name'       => 'aaa',
            'price'              => 108,
            'tax'                => 8,
            'tax_excluded_price' => 100,
            'sort_order'         => 1,
            'disabled'           => 0,
        ];
        $response = $this->post(route('item.store'), $data);
        $response->assertStatus(302);
        $response->assertRedirect('items');

        $this->assertDatabaseHas(
            'items',
            [
             'code'               => 100,
             'name'               => 'storeTestName3',
             'receipt_name'       => 'aaa',
             'price'              => 108,
             'tax'                => 8,
             'tax_excluded_price' => 100,
             'sort_order'         => 1,
            ],
        );
    }

    public function testShowItem()
    {
        $item4    = Item::factory()->create();
        $response = $this->get(route('item.show', $item4->id));
        $response->assertStatus(200);
        $response->assertSeeInOrder([
            $item4->name,
            $item4->order_start_time,
            $item4->order_end_time,
            $item4->sort_order,
            $item4->disabled,
        ]);
    }

    public function testUpdateItem()
    {
        $item5 = Item::factory()->create();
        $data  = [
         'code'               => 100,
         'name'               => 'supdateTestName',
         'receipt_name'       => 'aaa',
         'price'              => 108,
         'tax'                => 8,
         'tax_excluded_price' => 100,
         'sort_order'         => 1,
         'disabled'           => 1,
        ];
        $response = $this->put(route('item.update', $item5->id), $data);
        $response->assertStatus(302);
        $response->assertRedirect('items');

        $this->assertDatabaseHas('items', $data);
    }

    public function testDestroyItem()
    {
        $item6    = Item::factory()->create();
        $response = $this->delete(route('item.destroy', ['item' => $item6->id]));
        $response->assertStatus(302);
        $response->assertRedirect('items');
        $this->assertSoftDeleted($item6);
    }
}
