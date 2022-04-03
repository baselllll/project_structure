<?php

namespace App\Traits\Testing;

use App\Models\Company;
use App\Models\Product;
use App\Models\ProductPricing;
use App\Models\SpecialPrice;
use App\Models\Workshop;

trait GeneratesProducts
{
    public function generateProducts($count = 10, $prices_count = 5, $special_prices_count = 5)
    {
        return Product::factory()->count($count)
            ->has(
                ProductPricing::factory()
                    ->count($prices_count)
                    ->state(function () {

                        $chance_for_only_type_price = rand(0, 100);
                        $entities = [Workshop::class, Company::class];
                        $rand_type = $entities[rand(0, 1)];
                        if ($chance_for_only_type_price < 30) {
                            return ['priceable_type' => $rand_type];
                        } elseif ($chance_for_only_type_price > 30 && $chance_for_only_type_price < 60) {
                            return ['priceable_type' => $rand_type, 'priceable_id' => $rand_type::query()->inRandomOrder()->first('id')->id];
                        } else {
                            return [];
                        }

                    }),
                'pricing'
            )
            ->has(
                SpecialPrice::factory()
                    ->count($special_prices_count)
                    ->state(function () {

                        $chance_for_only_type_price = rand(0, 100);
                        $entities = [Workshop::class, Company::class];
                        $rand_type = $entities[rand(0, 1)];
                        if ($chance_for_only_type_price < 30) {
                            return ['priceable_type' => $rand_type];
                        } elseif ($chance_for_only_type_price > 30 && $chance_for_only_type_price < 60) {
                            return ['priceable_type' => $rand_type, 'priceable_id' => $rand_type::query()->inRandomOrder()->first('id')->id];
                        } else {
                            return [];
                        }

                    }),
                'special_pricing'
            )
            ->create();
    }
}
