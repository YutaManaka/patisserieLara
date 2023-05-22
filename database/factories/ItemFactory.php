<?php

namespace Database\Factories;

use App\Models\Config;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition()
    {
        $name             = $this->faker->text(20);
        $taxExcludedPrice = $this->faker->numberBetween(0, 9999);
        $roundingRule     = Config::where('key', 'rounding_rule')->first()?->value ?? Config::ROUNDING_UP;
        switch ($roundingRule) {
            default:
            case Config::ROUNDING_UP:
                $tax = ceil($taxExcludedPrice * 0.08);
                break;
            case Config::ROUNDING_DOWN:
                $tax = floor($taxExcludedPrice * 0.08);
                break;
            case Config::ROUNDING_OFF:
                $tax = round($taxExcludedPrice * 0.08);
                break;
        }

        return [
            'code'               => $this->faker->numberBetween(0, 29999),
            'img_url'            => null,
            'name'               => $name,
            'receipt_name'       => substr($name, 10),
            'description'        => $this->faker->text(50),
            'price'              => $taxExcludedPrice + $tax,
            'tax'                => $tax,
            'tax_excluded_price' => $taxExcludedPrice,
            'sort_order'         => 0,
            'disabled'           => 0,
        ];
    }
}
