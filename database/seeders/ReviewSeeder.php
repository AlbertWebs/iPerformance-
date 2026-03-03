<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['name' => 'Jane Wanjiku', 'company' => 'ABC Ltd', 'rating' => 5, 'content' => 'iPerformance Africa delivered an outstanding certification program. Our team now applies best practices consistently.'],
            ['name' => 'John Otieno', 'company' => 'XYZ Corp', 'rating' => 5, 'content' => 'Professional, practical, and highly relevant to our context. We have partnered with them for multiple trainings.'],
            ['name' => 'Mary Akinyi', 'company' => 'Tech Solutions', 'rating' => 4, 'content' => 'The workshop was well organized and the facilitators were knowledgeable. Would recommend.'],
        ];

        foreach ($items as $i => $item) {
            Review::create(array_merge($item, ['sort_order' => $i, 'is_active' => true]));
        }
    }
}
