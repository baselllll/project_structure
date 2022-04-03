<?php

namespace App\Traits\Testing;

use App\Models\Review;

trait GenerateReviews
{
    /**
     * @param int $count
     * @return mixed
     */
    public function generateReviews(int $count = 10)
    {
        return Review::factory()->count($count)->create();
    }
}
