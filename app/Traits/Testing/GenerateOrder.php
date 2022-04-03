<?php

namespace App\Traits\Testing;

use App\Models\Address;
use App\Models\Order;

trait GenerateOrder
{
    /**
     * @param int $count
     * @return mixed
     */
    public function generateOrder(int $count = 10)
    {
        return Order::factory()->count($count)
            ->has(Address::factory(), 'address')
            ->create();
    }
}
