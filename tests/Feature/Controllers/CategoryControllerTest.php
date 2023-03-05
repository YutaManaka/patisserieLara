<?php

namespace Tests\Feature\Controllers;

use App\Models\Category;
use App\Models\User;
use Tests\TestCase;
use Tests\WithDb;

class CategoryControllerTest extends TestCase
{
    use WithDb;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->post('/login', [
            'email' => $this->user->email,
            'password' => 'password',
        ]);
    }

   public function testIndexCategory()
   {
        $category  = Category::factory()->create();
        $category2 = Category::factory()->create();

        $response = $this->get(route('category'));
        $response->assertStatus(200);
        $response->assertSeeInOrder([
            $category->name,
            $category->order_start_time,
            $category->order_end_time,
            $category->sort_order,
            $category->disabled,
            $category2->name,
            $category2->order_start_time,
            $category2->order_end_time,
            $category2->sort_order,
            $category2->disabled,
        ]);
   }

   public function testCreateCategory()
   {
        $response = $this->get(route('category.create'));
        $response->assertStatus(200);
   }

   public function testStoreCategory()
   {
        $data = [
            'name'             => 'storeTestName3',
            'order_start_time' => '00:10',
            'order_end_time'   => '23:49',
            'sort_order'       => 2,
        ];
        $response = $this->post(route('category.store'), $data);
        $response->assertStatus(302);
        $response->assertRedirect('categories');

        $this->assertDatabaseHas(
            'categories',
            [
                'name'             => 'storeTestName3',
                'order_start_time' => '00:10',
                'order_end_time'   => '23:49',
                'sort_order'       => 2,
            ],
        );
   }

   public function testShowCategory()
   {
        $category4 = Category::factory()->create();
        $response = $this->get(route('category.show', $category4->id));
        $response->assertStatus(200);
        $response->assertSeeInOrder([
            $category4->name,
            $category4->order_start_time,
            $category4->order_end_time,
            $category4->sort_order,
            $category4->disabled,
        ]);
   }

   public function testUpdateCategory()
   {
        $category5 = Category::factory()->create();
        $data = [
            'name'             => 'updateTestName',
            'order_start_time' => '00:20',
            'order_end_time'   => '23:39',
            'sort_order'       => 3,
        ];
        $response = $this->put(route('category.update', $category5->id), $data);
        $response->assertStatus(302);
        $response->assertRedirect('categories');

        $this->assertDatabaseHas('categories', $data);
   }

   public function testDestroyCategory()
   {
        $category6 = Category::factory()->create();
        $response = $this->delete(route('category.destroy', [ 'category' => $category6->id]));
        $response->assertStatus(302);
        $response->assertRedirect('categories');
        $this->assertSoftDeleted($category6);
   }

   public function testDisableCategory()
   {
        $category7 = Category::factory()->create(); // disabled=0で作成
        $response = $this->put(route('category.disabled', $category7->id));
        $response->assertStatus(302);
        $response->assertRedirect('categories');

        $data = [
            'name'             => $category7->name,
            'order_start_time' => $category7->order_start_time,
            'order_end_time'   => $category7->order_end_time,
            'sort_order'       => $category7->sort_order,
            'disabled'         => 1,
        ];
        $this->assertDatabaseHas('categories', $data);
   }
}
