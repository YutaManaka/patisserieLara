<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'name'                    => $this->faker->word,
            'img_url'                 => null,
            'order_start_time'        => '00:00',
            'order_end_time'          => '23:59',
            'sort_order'              => 1,
            'disabled'                => 0,
        ];
    }
}
