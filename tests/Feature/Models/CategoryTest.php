<?php

namespace Tests\Feature\Models;

use App\Models\Category;
use Tests\TestCase;
use Tests\WithDb;

class CategoryTest extends TestCase
{
    use WithDb;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testFillable()
    {
        $attributes = [
            'name' => 'テスト',
            // 'image_url'        => 'https://example.png',
            'order_start_time' => '00:00',
            'order_end_time'   => '10:00',
            'sort_order'       => 1,
            'disabled'         => 0,
        ];
        $category = Category::create($attributes);
        $category->refresh();

        collect($attributes)
            ->each(fn ($val, $key) => $this->assertEquals($val, $category->$key));
    }

    public function testCreate()
    {
        $attributes = [
            'name' => 'テスト2',
            // 'image_url'        => 'https://example.png',
            'order_start_time' => '00:00',
            'order_end_time'   => '10:00',
            'sort_order'       => 1,
            'disabled'         => 0,
        ];
        Category::create($attributes);
        $categories = Category::get();
        $this->assertSame(1, $categories->count());
    }

    public function testDelete()
    {
        $attributes = [
            'name' => 'テスト3',
            // 'image_url'        => 'https://example4.png',
            'order_start_time' => '00:00',
            'order_end_time'   => '10:00',
            'sort_order'       => 1,
            'disabled'         => 0,
        ];
        $category = Category::create($attributes);

        $category->delete();
        $category->refresh();

        $this->assertSoftDeleted($category);
    }
}
